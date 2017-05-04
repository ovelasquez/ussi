<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Esperando;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Esperando controller.
 *
 * @Route("esperando")
 */
class EsperandoController extends Controller {

    /**
     * Lists all esperando entities.
     *
     * @Route("/", name="esperando_index")
     * @Method("GET")
     */
    public function indexAction() {
        $hoy = new \DateTime('now');
        $hoy->setTime(0, 0, 0);
        $em = $this->getDoctrine()->getManager();
        $configuracion = $em->getRepository('AppBundle:Configuracion')->findAll();
        $repository = $em->getRepository('AppBundle:Esperando');
        $query = $repository->createQueryBuilder('p')
                ->where('p.fechaRegistro >= :hoy')
                ->setParameter('hoy', $hoy)
                ->orderBy('p.posicion', 'ASC')
                ->getQuery();
        $esperandos = $query->getResult();
        //$esperandos = $em->getRepository('AppBundle:Esperando')->findAllByFecha();
        return $this->render('esperando/index.html.twig', array(
                    'esperandos' => $esperandos,
                    'penalizacion' => $configuracion[0]->getPenalizacion(),
        ));
    }

    /**
     * Procesar la Lista de  espera
     *
     * @Route("/procesar", name="esperando_procesar")
     * @Method("GET")
     */
    public function procesarAction(Request $request) {
        $id = 0;
        $em = $this->getDoctrine()->getManager();
        $configuracion = $em->getRepository('AppBundle:Configuracion')->findAll();
        $repetir = true;
        $esMio = false;
        $foto = '';
        $profesional = $em->getRepository('AppBundle:Profesional')->findOneByPersona($this->getUser()->getPersona());
        $servicioProfesional = $em->getRepository('AppBundle:ServicioProfesional')->findOneBy(array('profesional' => $profesional, 'status' => 'activo'));
        $especialidad = $em->getRepository('AppBundle:Especialidad')->find($servicioProfesional->getServicio()->getEspecialidad());

        //Buscamos al Primero de la Lista de Espera
        $esperandos = $em->getRepository('AppBundle:Esperando')->findBy(
                array('especialidad' => $especialidad, 'status' => 'activo',), array('posicion' => 'ASC')
        );

        //Cambiamos el estatus al paciente en la lista de espera de activo a procesando
        if ($esperandos) {
            $i = 0;
            do {
                // Verificamos si el Paciente no tiene asociado un Médico y en caso de ser afirmtivo, se verifica si es el Medico logueado
                if (($esperandos[$i]->getProfesional() == null) || ($esperandos[$i]->getProfesional()->getId() == $profesional->getId())) {
                    $esperandos[$i]->setStatus('procesando'); //Cambiamos status en la BD a Procesando
                    $esperandos[$i]->setMedico($profesional);  // Add el Profesional que lo esta llamando
                    $em->flush($esperandos[$i]);
                    $id = $esperandos[$i]->getId();
                    $repetir = FALSE;
                    $esperandos = $esperandos[$i];
                    $foto = $esperandos->getPaciente()->getPersona()->getFoto();
                    $nombre = $esperandos->getPaciente()->getPersona()->getPrimerNombre() . ' ' . $esperandos->getPaciente()->getPersona()->getPrimerApellido();
                    $esMio = true;
                }
                $i++;
            } while ($repetir && ($i < count($esperandos)));
        }
        if (!$esMio) {
            $esperandos = null;
        }
        return $this->render('esperando/procesar.html.twig', array(
                    'esperando' => $esperandos,
                    'tiempoEspera' => $configuracion[0]->getTiempoEspera(),
                    'penalizacion' => $configuracion[0]->getPenalizacion(),
                    'id' => $id,
                    'foto' => $foto,
                    'nombre' => $nombre,
        ));
    }

    /**
     * Procesando al Paciente que fue llamado de la lista de espera
     *
     * @Route("/procesando/{id}/{llego}", name="esperando_procesando")
     * @Method("GET")
     */
    public function procesandoAction(Request $request, $id, $llego) {
        $em = $this->getDoctrine()->getManager();
        $esperandos = $em->getRepository('AppBundle:Esperando')->find($id);
        if ($esperandos) {
            if ($llego == 1) { //El Paciente llego al consultorio y le abriran su consulta
                $esperandos->setStatus('atendido');
                $esperandos->setPosicion(null);
                $em->flush($esperandos);
                //dump($esperandos->getEspecialidad()->getNombre()); die();
                switch ($esperandos->getEspecialidad()->getNombre()) {              
                    case('Enfermería'): 
                        return $this->redirectToRoute('homepage_enfermeria', array('paciente' => $esperandos->getPaciente()->getId()));
                        break;
                     case('Odontología'): 
                        return $this->redirectToRoute('homepage_odontologia', array('paciente' => $esperandos->getPaciente()->getId()));
                        break;
                    default: return $this->redirectToRoute('homepage_consulta', array('paciente' => $esperandos->getPaciente()->getId()));
                }
                
            } else {
                //El Paciente NO llego al consultorio y será penalizado
                //Se verifica que no ha alcanzado el limite de penalizaciones, 
                //de ser cierto se le cambiará el status a abandono y no se llamará más
                $configuracion = $em->getRepository('AppBundle:Configuracion')->findAll();
                $esperandos->setPenalizacion($esperandos->getPenalizacion() + 1);

                if ($esperandos->getPenalizacion() < $configuracion[0]->getPenalizacion()) {
                    $esperandos->setStatus('activo');
                    //Buscamos al Primero de la Lista de Espera
                    $listaEspera = $em->getRepository('AppBundle:Esperando')->findBy(
                            array('especialidad' => $esperandos->getEspecialidad(), 'status' => 'activo',), array('posicion' => 'ASC')
                    );
                    if ($listaEspera) {
                        $miPosicion = $esperandos->getPosicion();
                        $i = 0;
                        $repetir = true;
                        do {
                            if ($listaEspera[$i]->getPosicion() > $miPosicion) {
                                $esperandos->setPosicion($listaEspera[$i]->getPosicion());
                                $listaEspera[$i]->setPosicion($miPosicion);
                                $em->flush($listaEspera[$i]);
                                $repetir = false;
                            }
                            $i++;
                        } while ($repetir && ($i < count($listaEspera)));
                    }
                } else {
                    $esperandos->setStatus('abandono');
                    $esperandos->setPosicion(null);
                }
                $em->flush($esperandos);
                return $this->redirectToRoute('homepage');
            }
        }
    }

    /**
     * Creates a new esperando entity.
     *
     * @Route("/new", name="esperando_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request) {
        $esperando = new Esperando();
        $form = $this->createForm('AppBundle\Form\EsperandoType', $esperando);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($esperando);
            $em->flush($esperando);

            return $this->redirectToRoute('esperando_show', array('id' => $esperando->getId()));
        }

        return $this->render('esperando/new.html.twig', array(
                    'esperando' => $esperando,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a esperando entity.
     *
     * @Route("/{id}", name="esperando_show")
     * @Method("GET")
     */
    public function showAction(Esperando $esperando) {
        $deleteForm = $this->createDeleteForm($esperando);


        return $this->render('esperando/show.html.twig', array(
                    'esperando' => $esperando,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing esperando entity.
     *
     * @Route("/{id}/edit", name="esperando_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Esperando $esperando) {
        $deleteForm = $this->createDeleteForm($esperando);
        $editForm = $this->createForm('AppBundle\Form\EsperandoType', $esperando);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Datos actualizados satisfactoriamente');
            return $this->redirectToRoute('esperando_show', array('id' => $esperando->getId()));
        }

        return $this->render('esperando/edit.html.twig', array(
                    'esperando' => $esperando,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a esperando entity.
     *
     * @Route("/{id}", name="esperando_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Esperando $esperando) {
        $form = $this->createDeleteForm($esperando);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            //Si eliminamos al paciente volvemos a incrementar la disponibilidad de la Especialidad
            $servicio = $em->getRepository('AppBundle:Servicio')->findOneBy(
                    array(
                        'especialidad' => $esperando->getEspecialidad(),
                        'dia' => date('N', strtotime((string) $esperando->getFechaRegistro()->format('m/d/Y'))),
            ));
            $servicio->setDisponible($servicio->getDisponible() + 1);
            $em->persist($servicio);
            $em->flush($servicio);

            //Eliminamos alpaciente de la lista de espera
            $em->remove($esperando);
            $em->flush($esperando);
        }

        return $this->redirectToRoute('esperando_index');
    }

    /**
     * Creates a form to delete a esperando entity.
     *
     * @param Esperando $esperando The esperando entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Esperando $esperando) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('esperando_delete', array('id' => $esperando->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}

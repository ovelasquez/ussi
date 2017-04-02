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
     * Lists all esperando
     *
     * @Route("/procesar", name="esperando_procesar")
     * @Method("GET")
     */
    public function procesarAction(Request $request) {
        $id = 0;

        $em = $this->getDoctrine()->getManager();
        $configuracion = $em->getRepository('AppBundle:Configuracion')->findAll();
        $repetir = true;
        $foto = '';

        //Datos Cableados
        $especialidad = ["Medicina General", "Medicina Interna", "Pediatría"];
        $especialidad = $especialidad[rand(0, 2)];
       // $esMio = false;
        $miId = 2;

        //dump($especialidad);

        $miEspecialidad = $em->getRepository('AppBundle:Especialidad')->findByNombre($especialidad);

        //Buscamos al Primero de la Lista de Espera
        $esperandos = $em->getRepository('AppBundle:Esperando')->findBy(
                array('especialidad' => $miEspecialidad, 'status' => 'activo',), array('posicion' => 'ASC')
        );


        // dump($esperandos); die();
        //Cambiamos el estatus al paciente en la lista de espera de activo a procesando
        if ($esperandos) {
            $i = 0;
            do {
                // Verificamos si el Paciente no tiene asociado un Médico y en caso de ser afirmtivo, se verifica si es el Medico logueado
                if (($esperandos[$i]->getProfesional() == null) || ($esperandos[$i]->getProfesional()->getId() == $miId)) {
                    $esperandos[$i]->setStatus('procesando');
                    $em->flush($esperandos[$i]); //Cambiamos status en la BD a Procesando
                    $id = $esperandos[$i]->getId();
                    $repetir = FALSE;
                    $esperandos = $esperandos[$i];
                    $foto = $esperandos->getPaciente()->getPersona()->getFoto();
                   // $esMio = true;
                }
                $i++;
            } while ($repetir && ($i < count($esperandos)));
        }

        //    if (!$esMio) {
        // $esperandos = $esperandos;
        //} else {
        //        $esperandos = null;
        //   }

        return $this->render('esperando/procesar.html.twig', array(
                    'esperando' => $esperandos,
                    'tiempoEspera' => $configuracion[0]->getTiempoEspera(),
                    'penalizacion' => $configuracion[0]->getPenalizacion(),
                    'id' => $id,
                    'foto' => $foto,
        ));
    }

    /**
     * Lists all esperando entities.
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
                return $this->redirectToRoute('paciente_show', array('id' => $esperandos->getPaciente()->getId()));
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
                    // dump($listaEspera); die();

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
                            } else {
                                //$repetir = false;
                            }
                            $i++;
                        } while ($repetir && ($i < count($listaEspera)));
                    }
                } else {
                    $esperandos->setStatus('abandono');
                    $esperandos->setPosicion(null);
                }
                $em->flush($esperandos);
                return $this->redirectToRoute('esperando_index');
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

            return $this->redirectToRoute('esperando_edit', array('id' => $esperando->getId()));
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

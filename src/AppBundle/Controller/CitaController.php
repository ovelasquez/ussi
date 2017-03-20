<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Cita;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use AppBundle\Entity\Profesional;

/**
 * Citum controller.
 *
 * @Route("cita")
 */
class CitaController extends Controller {

    /**
     * Lists all citum entities.
     *
     * @Route("/", name="cita_index")
     * @Method("GET")
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $citas = $em->getRepository('AppBundle:Cita')->findAll();

        return $this->render('cita/index.html.twig', array(
                    'citas' => $citas,
        ));
    }

    /**
     * Creates a new citum entity.
     *
     * @Route("/new", name="cita_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request) {
        $cita = new Cita();
        $form = $this->createForm('AppBundle\Form\CitaType', $cita);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($cita);
            $em->flush($cita);

            return $this->redirectToRoute('cita_show', array('id' => $cita->getId()));
        }

        return $this->render('cita/new.html.twig', array(
                    'citum' => $cita,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Creates a consulta entity.
     *
     * @Route("/consulta", name="cita_consulta")
     * @Method({"GET", "POST"})
     */
    public function consultaAction(Request $request) {

        // Buscamos todos los servicios Disponibles del Día.
        $em = $this->getDoctrine()->getManager();
        $servicio = $em->getRepository('AppBundle:Servicio')->findByDia(date("w"));
        $hoy = new \DateTime('now');
        $hoy->setTime(0, 0, 0);
        $profesionalDisponible=null;
        foreach ($servicio as &$valor) {
            if (!($hoy == $valor->getFecha())) {
                $valor->setDisponible($valor->getCupo()); //Restablecer los cupos disponibles
                $valor->setFecha(new \DateTime("now"));   //actualizamos la fecha
                $em->persist($valor);
                $em->flush($valor);
            }
        }

        //Creamos el formulario de Consulta
        $form = $this->createFormBuilder()
                ->setAction($this->generateUrl('cita_consulta'))
                ->add('nacionalidad', ChoiceType::class, array(
                    'choices' => array('Venezolana' => 'V', 'Extranjera' => 'E'),
                    'required' => true,
                    'label' => 'Nacionalidad',
                    'attr' => array('placeholder' => 'Nacionalidad')
                ))
                ->add('cedula', TextType::class, array(
                    'label' => 'Cédula / Pasaporte',
                    'required' => true,
                    'attr' => array('placeholder' => 'Número de Cédula / Pasaporte'),
                ))
                ->add('especialidad', TextType::class, array(
                    'label' => 'Especialidad',
                    'required' => true,
                    'attr' => array('placeholder' => 'Especialidad'),
                ))
                ->getForm();
        $form->handleRequest($request);

        //<input type="hidden" id="form__token" name="form[_token]" value="1tME9nbWbI5i_5PEY4PgC9BjrBgjY_Df8nbxwHBJw4I">

        if ($request->isMethod('POST')) {
            $var = $request->request->get('form');

            $persona = $em->getRepository('AppBundle:Persona')->findOneBy(
                    array(
                        'nacionalidad' => $var['nacionalidad'],
                        'cedula' => $var['cedula']
                    )
            );

            $especialidad = $em->getRepository('AppBundle:Especialidad')->findOneBy(
                    array(
                        'nombre' => $var['especialidad'],
                    )
            );


            if ($persona) {
                $paciente = $em->getRepository('AppBundle:Paciente')->findOneBy(array('persona' => $persona));
            } else {
                return $this->redirectToRoute('paciente_new');
            }

            //Verificamos si esta en la lista de espera           
            $estaEsperando = $em->getRepository('AppBundle:Esperando')->findByPaciente($paciente);
            $cont = 0;
            foreach ($estaEsperando as &$valor) {
                if (($hoy == $valor->getFechaRegistro()->setTime(0, 0, 0))) {
                    $cont = $cont + 1;
                }
            }
            $numeroConsultas = $em->getRepository('AppBundle:Configuracion')->findAll();
            if ($numeroConsultas[0]->getNumeroConsultas() == $cont) {
                die("Ha alcanzado el número máximo de consultas (" . (string) $numeroConsultas[0]->getNumeroConsultas() . ") por el día de hoy.");
            } else {
                //Verificamos si tiene una Cita Sucesiva en la especialidad seleccionada
                $cita = $em->getRepository('AppBundle:Cita')->findBy(
                        array(
                            'paciente' => $paciente,
                            'fecha' => $hoy,
                            'especialidad' => $especialidad,
                        )
                );
                //Creamos Lista de Espera
                $listaEspera = new \AppBundle\Entity\Esperando();
                $listaEspera->setPaciente($paciente);
                $listaEspera->setStatus("activo");
                $listaEspera->setEspecialidad($especialidad);
                $listaEspera->setFechaRegistro(new \DateTime("now"));

                if (!$cita) {
                    //No posee cita, entonces lo asignamos a la Lista de Espera
                    $listaEspera->setProfesional(null);
                } else {
                    //Verificamos si el Profesional esta de Servicio o notifico que no asistía
                    //$profesionale = new Profesional();
                    //$profesionale = $cita[0]->getProfesional();
                    //dump($profesionale); die();
                    $profesionalDisponible = $this->disponibleProfesional($cita[0]->getProfesional());
                    if ($profesionalDisponible!=null&&$profesionalDisponible=="activo") {
                        $listaEspera->setProfesional($cita[0]->getProfesional());
                        $em->persist($listaEspera);
                        $em->flush($listaEspera);
                    } else {
                        //return $this->render('cita/servicios.html.twig', array('profesionalDisponible' => $profesionalDisponible));
                        dump($profesionalDisponible);
                    }
                }
            }
        }
        
        return $this->render('cita/consulta.html.twig', array(
                    'servicios' => $servicio,
                    'form' => $form->createView(),
                    'profesionalDisponible'=> $profesionalDisponible,
        ));
    }

    private function disponibleProfesional(Profesional $profesional) {
        $em = $this->getDoctrine()->getManager();
        $profesionalDisponible = $em->getRepository('AppBundle:ServicioProfesional')->findOneBy(
                array(
                    'profesional' => $profesional,                    
                )
        );
        /* if ($profesionalDisponible) {
          return TRUE;
          } else {
          return FALSE
          ;
          } */
        return $profesionalDisponible;
    }

    /**
     * Finds and displays a citum entity.
     *
     * @Route("/servicios", name="cita_servicios")
     * @Method("GET")
     */
    public function serviciosAction() {


        return $this->render('cita/servicios.html.twig', array(
        ));
    }

    /**
     * Finds and displays a citum entity.
     *
     * @Route("/{id}", name="cita_show")
     * @Method("GET")
     */
    public function showAction(Cita $cita) {
        $deleteForm = $this->createDeleteForm($cita);

        return $this->render('cita/show.html.twig', array(
                    'citum' => $cita,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing citum entity.
     *
     * @Route("/{id}/edit", name="cita_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Cita $cita) {
        $deleteForm = $this->createDeleteForm($cita);
        $editForm = $this->createForm('AppBundle\Form\CitaType', $cita);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cita_edit', array('id' => $cita->getId()));
        }

        return $this->render('cita/edit.html.twig', array(
                    'citum' => $cita,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a citum entity.
     *
     * @Route("/{id}", name="cita_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Cita $cita) {
        $form = $this->createDeleteForm($cita);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($cita);
            $em->flush($cita);
        }

        return $this->redirectToRoute('cita_index');
    }

    /**
     * Creates a form to delete a citum entity.
     *
     * @param Cita $cita The citum entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Cita $cita) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('cita_delete', array('id' => $cita->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}

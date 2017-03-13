<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Cita;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

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
                ->getForm();
        $form->handleRequest($request);

        //if ($request->isMethod('POST')) {
            $var = $request->request->get('form');
            $cedula = $var['cedula'];
            $nacionalidad = $var['nacionalidad'];
            $registroPaciente = false;

            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $persona = $em->getRepository('AppBundle:Persona')->findBy(array('cedula' => $cedula, 'nacionalidad' => $nacionalidad));
                if ($persona) {
                    $paciente = $em->getRepository('AppBundle:Paciente')->findBy(array('persona' => $persona));
                    if ($paciente) {
                        $cita = $em->getRepository('AppBundle:Cita')->findBy(array('paciente' => $paciente, 'status' => 'Activa', 'fecha' => new \DateTime("now")));
                        if ($cita) {
                            //dump($cita);
                            //Verifico si esta disponible el medico y la especialidad a la que esta referido 
                            $profesionalEspecialidad = $em->getRepository('AppBundle:ProfesionalEspecialidad')->findBy(array('profesional' => $cita[0]->getProfesional(), 'especialidad' => $cita[0]->getEspecialidad()));
                            if ($profesionalEspecialidad) {
                                $disponible = $em->getRepository('AppBundle:Disponible')->findBy(array('profesionalEspecialidad' => $profesionalEspecialidad));
                                if ($disponible) {
                                    //Medico - Especialidad referenciado => Disponible
                                    return $this->redirectToRoute('cita_servicios');
                                   /* 
                                    //Add a la lista de Espera
                                    $esperando = new \AppBundle\Entity\Esperando();
                                    $esperando->setEspecialidad($cita[0]->getEspecialidad());
                                    $esperando->setProfesional($cita[0]->getProfesional());
                                    $esperando->setFechaRegistro(new \DateTime("now"));
                                    $esperando->setStatus('Activo');
                                    $esperando->setPaciente($paciente[0]);
                                    $em->persist($esperando);
                                    $em->flush($esperando);
                                    
                                    //Update al status de la cita
                                    $cita[0]->setStatus('No Activa');
                                    $em->persist($cita[0]);
                                    $em->flush($cita[0]);
                                    dump($esperando);
                                    dump($cita[0]);
                                    die();
                                    
                                    */
                                } else {
                                    //Medico - Especialidad referenciado => No Disponible                                 
                                    $profesionalEspecialidad = $em->getRepository('AppBundle:ProfesionalEspecialidad')->findBy(array('especialidad' => $cita[0]->getEspecialidad()));
                                    if ($profesionalEspecialidad) {
                                        echo"Medicos disponibles: " . count($profesionalEspecialidad) . "</br>";
                                        foreach ($profesionalEspecialidad as &$valor) {
                                            $disponible = $em->getRepository('AppBundle:Disponible')->findBy(array('profesionalEspecialidad' => $valor));
                                            dump($disponible);
                                        }

                                        die();
                                    }
                                }
                            } else {
                                die('medico - especialidad (combinacion) no existe en la USSI');
                                //Si no esta disponible, buscamos todos los médicos de esa especialidad
                            }
                        }
                    } else {
                        die('No es paciente');
                        $this->addFlash('error', 'La persona con la identificación: ' . $nacionalidad . ' - ' . $cedula . ' no está registrada como Paciente');
                        $registroPaciente = true;
                    }
                } else {
                    die('No es persona');
                    $this->addFlash('error', 'La persona con la identificación: ' . $nacionalidad . ' - ' . $cedula . ' no está registrada como Persona');
                    $registroPaciente = true;
                }

                if ($registroPaciente === \TRUE) {
                    return $this->redirectToRoute('paciente_new');
                }
            } 
       //}        die(';(');
        return $this->render('cita/consulta.html.twig', array(
                    'form' => $form->createView(),
        ));
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

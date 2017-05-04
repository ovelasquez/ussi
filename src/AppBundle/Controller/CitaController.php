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
        $consulta = NULL;
        $em = $this->getDoctrine()->getManager();
        if ($request->request->get('cita_consulta')) {
            $consulta = $em->getRepository('AppBundle:Consulta')->find($request->request->get('cita_consulta'));
        }

        $cita = new Cita();

        if ($consulta) {
            $cita->setConsulta($consulta);
            $cita->setPaciente($consulta->getPaciente());
        }

        $form = $this->createForm('AppBundle\Form\CitaType', $cita);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hoy = new \DateTime('now');
            $hoy->setTime(0, 0, 0);
            //Verificamos si la Cita que estan dando es para hoy, para anexar al paciente en la lista de espera
            if ($cita->getFecha() == $hoy) {
                $listaEspera = $this->profesionalCitaListaEspera($cita);

                if ($listaEspera) {
                    $em->persist($cita);
                    $em->flush($cita);
                }
            } else {
                $em->persist($cita);
                $em->flush($cita);
            }                        
            
            $this->addFlash('success', 'Cita registrada satisfactoriamente');
            switch ($cita->getConsulta()->getEspecialidad()->getNombre()) {
                case('Odontología'): return $this->redirectToRoute('homepage_odontologia', array('paciente' => $cita->getPaciente()->getId(),));
                    break;
                case('Enfermería'): return $this->redirectToRoute('homepage_enfermeria', array('paciente' => $cita->getPaciente()->getId(),));
                    break;
                default : return $this->redirectToRoute('homepage_consulta', array('paciente' => $cita->getPaciente()->getId(),));
                    break;
            }
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
        $hoy = new \DateTime('now');
        $hoy->setTime(0, 0, 0);
        $profesionalDisponible = null;
        $doctor = '';
        $nombrePersona = null;
        $observacion = '';
        $maximoConsulta = null;
        $cola = null;
//Parametrización de la aplicacion por BD
        $em = $this->getDoctrine()->getManager();
        $configuracion = $em->getRepository('AppBundle:Configuracion')->findAll();
        if ($hoy != $configuracion[0]->getServicioActualizado()) {
            $this->setServicio();
        }
//Medicos / Especialidades disponibles para hoy
        $misServicos = $this->disponibleServicio();

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
                ->add('medico', TextType::class)
                ->getForm();
        $form->handleRequest($request);

//Verificamos si es enviado 
        if ($request->isMethod('POST')) {
            $var = $request->request->get('form');

            $persona = $em->getRepository('AppBundle:Persona')->findOneBy(array('nacionalidad' => $var['nacionalidad'], 'cedula' => $var['cedula']));
            $especialidad = $em->getRepository('AppBundle:Especialidad')->findOneBy(array('nombre' => $var['especialidad'],));

            if ($persona) {
                $paciente = $em->getRepository('AppBundle:Paciente')->findOneBy(array('persona' => $persona));

                $nombrePersona = $persona->getPrimerApellido() . ' ' . $persona->getPrimerNombre();
            } else {
                return $this->redirectToRoute('paciente_new');
            }

//Verifica cuantos servicios esta solicitando en el dia de hoy
            $cont = $this->estoyEsperando($paciente);

            if ($configuracion[0]->getNumeroConsultas() == $cont) {
                $maximoConsulta = "Ha alcanzado el número máximo de consultas (" . (string) $configuracion[0]->getNumeroConsultas() . ") diarias.";
            } else {
//Verificamos si tiene una Cita Sucesiva en la especialidad seleccionada
                $cita = $em->getRepository('AppBundle:Cita')->findBy(
                        array(
                            'paciente' => $paciente,
                            'fecha' => $hoy,
                            'especialidad' => $especialidad,
                            'status' => 'activo',
                        )
                );


//Creamos Lista de Espera
                $listaEspera = new \AppBundle\Entity\Esperando();
                $listaEspera->setPaciente($paciente);
                $listaEspera->setStatus("activo");
                $listaEspera->setEspecialidad($especialidad);
                $listaEspera->setFechaRegistro(new \DateTime("now"));

//Verificamos cual es el ultimo numero de la lista de espera
                $ultimoListaEspera = $em->getRepository('AppBundle:Cita')->findOneByPosicion(0);
                $listaEspera->setPosicion($ultimoListaEspera['posicion'] + 1);


                if (!$cita || $var['medico'] == 'Verdad') {
//No posee cita, entonces lo asignamos a la Lista de Espera
                    $listaEspera->setProfesional(null);
                    if ($this->disponibilidadServicio($especialidad) > 0) {
                        $em->persist($listaEspera);
                        $em->flush($listaEspera);
                        $this->descontandoDisponibilidadServicio($especialidad);
                        $cola = $this->enCola($especialidad, $listaEspera->getProfesional());
                        $misServicos = $this->disponibleServicio();
                    }
                } else {
//Caso en que el Paciente posee una Cita 


                    $servicio = $this->buscarServicio($especialidad); //Verificamos si la especialidad esta disponible en el día de hoy
// Verificamos si la Cita  tiene asignado un Doctor 
                    if ($cita[0]->getProfesional() != null) {
//Verificamos si el Doctor esta atendiendo
                        $profesionalDisponible = new \AppBundle\Entity\ServicioProfesional();
                        $profesionalDisponible = $this->disponibleProfesional($cita[0]->getProfesional(), $servicio);

                        if ($profesionalDisponible != null && $profesionalDisponible->getStatus() == "activo") {

                            $listaEspera->setProfesional($cita[0]->getProfesional()); //Asignamos al Doctor al Paciente en la Lista de Espera
//Verificar si hay disponibilidad de consultas en la Especialidad
                            if ($this->disponibilidadServicio($especialidad) > 0) {
                                $em->persist($listaEspera);
                                $em->flush($listaEspera);
                                $this->descontandoDisponibilidadServicio($especialidad);
                                $cola = $this->enCola($especialidad, $listaEspera->getProfesional());
                                $misServicos = $this->disponibleServicio();
                            }
                        } else {
//Si tiene Dr asociado y no esta disponible entonces obtenemos su nombre y el mensaje de por que no esta disponible
                            $doctor = $profesionalDisponible->getProfesional()->getPersona()->getPrimerApellido() . ' ' . $profesionalDisponible->getProfesional()->getPersona()->getPrimerNombre();
                            $observacion = $profesionalDisponible->getObservacion();
                        }
                    } else {
                        if ($this->disponibilidadServicio($especialidad) > 0) {
                            $em->persist($listaEspera);
                            $em->flush($listaEspera);
                            $this->descontandoDisponibilidadServicio($especialidad);
                            $cola = $this->enCola($especialidad, $listaEspera->getProfesional());
                            $misServicos = $this->disponibleServicio();
                        }
                    }
                }
            }
        }
// dump($cola);

        return $this->render('cita/consulta.html.twig', array(
                    'servicios' => $misServicos,
                    'form' => $form->createView(),
                    'profesionalDisponible' => $profesionalDisponible,
                    'doctor' => $doctor,
                    'observacion' => $observacion,
                    'maximoConsulta' => $maximoConsulta,
                    'cola' => $cola,
                    'persona' => $nombrePersona,
        ));
    }

    private function estoyEsperando($paciente) {
        $em = $this->getDoctrine()->getManager();
//Verificamos si esta en la lista de espera           
        $estaEsperando = $em->getRepository('AppBundle:Esperando')->findByPaciente($paciente);
        $hoy = new \DateTime('now');
        $hoy->setTime(0, 0, 0);
        $cont = 0;

        foreach ($estaEsperando as &$valor) {
            if (($hoy == $valor->getFechaRegistro()->setTime(0, 0, 0))) {
                $cont = $cont + 1;
            }
        }

        return ($cont);
    }

    private function buscarServicio($especialidad) {
        $em = $this->getDoctrine()->getManager();
//Verificamos si la especialidad esta disponible para ese dia                 
        $servicio = $em->getRepository('AppBundle:Servicio')->findBy(
                array(
                    'especialidad' => $especialidad,
                    'dia' => date("w"),
                )
        );
        return $servicio[0];
    }

    private function descontandoDisponibilidadServicio($especialidad) {
        $em = $this->getDoctrine()->getManager();
//Verificamos si esta en la lista de espera                 
        $servicio = $em->getRepository('AppBundle:Servicio')->findBy(
                array(
                    'especialidad' => $especialidad,
                    'dia' => date("w"),
                )
        );

        $servicio[0]->setDisponible($servicio[0]->getDisponible() - 1);
        $em->persist($servicio[0]);
        $em->flush($servicio[0]);
    }

    private function disponibilidadServicio($especialidad) {
        $em = $this->getDoctrine()->getManager();
//Verificamos si esta en la lista de espera                 
        $servicio = $em->getRepository('AppBundle:Servicio')->findBy(
                array(
                    'especialidad' => $especialidad,
                    'dia' => date("w"),
                )
        );
        return $servicio[0]->getDisponible();
    }

    private function enCola($especialidad, $profesional) {
        $em = $this->getDoctrine()->getManager();
        if ($profesional != NULL) {
            $cola = $em->getRepository('AppBundle:Esperando')->findBy(
                    array(
                        'especialidad' => $especialidad,
                        'status' => 'activo',
                        'profesional' => $profesional,
                    )
            );
        } else {
            $cola = $em->getRepository('AppBundle:Esperando')->findBy(
                    array(
                        'especialidad' => $especialidad,
                        'status' => 'activo',
                    )
            );
        }

        return count($cola);
    }

    private function disponibleProfesional(Profesional $profesional, $servicio) {
        $em = $this->getDoctrine()->getManager();
        $profesionalDisponible = $em->getRepository('AppBundle:ServicioProfesional')->findOneBy(
                array(
                    'profesional' => $profesional,
                    'servicio' => $servicio,
                )
        );

        return $profesionalDisponible;
    }

    /**
     * Buscamos todos los servicios Disponibles del Día, que tengan asociados por lo menos un Dr y este disponible.
     *
     */
    private function disponibleServicio() {
        $em = $this->getDoctrine()->getManager();
        $servicio = $em->getRepository('AppBundle:Cita')->findAllByServiosProfesionales(date("w"));

        $unServicio = array();
        $misServicos = array();

        foreach ($servicio as &$valor) {
            if (!in_array($valor['nombre'], $unServicio)) {
                array_push($misServicos, $valor);
                array_push($unServicio, $valor['nombre']);
            }
        }
        return $misServicos;
    }

    /**
     * Buscamos todos los servicios Disponibles del Día, que tengan asociados por lo menos un Dr y este disponible.
     *
     */
    private function setServicio() {
// Buscamos todos los servicios Disponibles.
        $hoy = new \DateTime('now');
        $hoy->setTime(0, 0, 0);
        $em = $this->getDoctrine()->getManager();
        $servicio = $em->getRepository('AppBundle:Servicio')->findByDia(date("w"));

        foreach ($servicio as &$valor) {
            if (!($hoy == $valor->getFecha())) {
                $valor->setDisponible($valor->getCupo()); //Restablecer los cupos disponibles
                $valor->setFecha(new \DateTime("now"));   //actualizamos la fecha
                $em->persist($valor);
                $em->flush($valor);
            }
        }

        $configuracion = $em->getRepository('AppBundle:Configuracion')->findAll();
        $configuracion[0]->setServicioActualizado($hoy);
        $em->persist($configuracion[0]);
        $em->flush($configuracion[0]);

//Setear Lista de Espera
        $esperando = $em->getRepository('AppBundle:Esperando')->findByStatus('activo');
        foreach ($esperando as &$valor) {
            $valor->setStatus('abandono'); //El Paciente no se presento a la consulta
            $valor->setPosicion(null);
            $em->persist($valor);
            $em->flush($valor);
        }
    }

    /**
     * Finds and displays a citum entity.
     *
     * @Route("/servicios", name="cita_servicios")
     * @Method("GET")
     */
    public function serviciosAction() {

        return $this->render('cita/servicios.html.twig', array());
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
            $this->addFlash('success', 'Cita actualizada satisfactoriamente');

           switch ($cita->getConsulta()->getEspecialidad()->getNombre()) {
                case('Odontología'): return $this->redirectToRoute('homepage_odontologia', array('paciente' => $cita->getPaciente()->getId(),));
                    break;
                case('Enfermería'): return $this->redirectToRoute('homepage_enfermeria', array('paciente' => $cita->getPaciente()->getId(),));
                    break;
                default : return $this->redirectToRoute('homepage_consulta', array('paciente' => $cita->getPaciente()->getId(),));
                    break;
            }
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
        
         $this->addFlash('success', 'Cita eliminada satisfactoriamente');

           switch ($cita->getConsulta()->getEspecialidad()->getNombre()) {
                case('Odontología'): return $this->redirectToRoute('homepage_odontologia', array('paciente' => $cita->getPaciente()->getId(),));
                    break;
                case('Enfermería'): return $this->redirectToRoute('homepage_enfermeria', array('paciente' => $cita->getPaciente()->getId(),));
                    break;
                default : return $this->redirectToRoute('homepage_consulta', array('paciente' => $cita->getPaciente()->getId(),));
                    break;
            }

        
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

    private function profesionalCitaListaEspera($cita) {

        $em = $this->getDoctrine()->getManager();
//Creamos Lista de Espera 
        $listaEspera = new \AppBundle\Entity\Esperando();
        $listaEspera->setPaciente($cita->getPaciente());
        $listaEspera->setStatus("activo");
        $listaEspera->setEspecialidad($cita->getEspecialidad());
        $listaEspera->setFechaRegistro(new \DateTime("now"));

//Verificamos cual es la prioridad de la cita y le asignamos un valor a la posicion
        switch ($cita->getPrioridad()) {
            case ('normal'): $ultimoListaEspera = $em->getRepository('AppBundle:Cita')->findOneByPosicion(0);
                $listaEspera->setPosicion($ultimoListaEspera['posicion'] + 1);
                break;
            case ('emergencia'): $listaEspera->setPosicion(0);
                break;
            case ('alta'): $listaEspera->setPosicion(0);
                break;
        }


//Caso en que el Paciente posee una Cita 

        $servicio = $this->buscarServicio($cita->getEspecialidad()); //Verificamos si la especialidad esta disponible en el día de hoy
// Verificamos si la Cita  tiene asignado un Doctor 
        if ($cita->getProfesional() != null) {
//Verificamos si el Doctor esta atendiendo
            $profesionalDisponible = new \AppBundle\Entity\ServicioProfesional();
            $profesionalDisponible = $this->disponibleProfesional($cita->getProfesional(), $servicio);

            if ($profesionalDisponible != null && $profesionalDisponible->getStatus() == "activo") {

                $listaEspera->setProfesional($cita->getProfesional()); //Asignamos al Doctor al Paciente en la Lista de Espera
//Verificar si hay disponibilidad de consultas en la Especialidad
                if ($this->disponibilidadServicio($cita->getEspecialidad()) > 0) {
                    $em->persist($listaEspera);
                    $em->flush($listaEspera);
                    $this->descontandoDisponibilidadServicio($cita->getEspecialidad());
                    $this->addFlash('success', 'Cita Registrada satisfactoriamente');
//$cola = $this->enCola($especialidad, $listaEspera->getProfesional());
//$misServicos = $this->disponibleServicio();
                }
            } else {
//Si tiene Dr asociado y no esta disponible entonces obtenemos su nombre y el mensaje de por que no esta disponible
                $doctor = $profesionalDisponible->getProfesional()->getPersona()->getPrimerApellido() . ' ' . $profesionalDisponible->getProfesional()->getPersona()->getPrimerNombre();
                $observacion = $profesionalDisponible->getObservacion();
                $this->addFlash('error', 'Cita No Registrada.  El Dr. ' . $doctor . ' no disponible (' . $observacion . ' ).');
                $listaEspera = null;
            }
        } else {
            if ($this->disponibilidadServicio($cita->getEspecialidad()) > 0) {
                $em->persist($listaEspera);
                $em->flush($listaEspera);
                $this->descontandoDisponibilidadServicio($cita->getEspecialidad());
                $this->addFlash('success', 'Cita Registrada satisfactoriamente');
// $cola = $this->enCola($especialidad, $listaEspera->getProfesional());
// $misServicos = $this->disponibleServicio();
            }
        }
        return $listaEspera;
    }

}

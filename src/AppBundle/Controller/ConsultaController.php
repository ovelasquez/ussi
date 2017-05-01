<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Consulta;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Consultum controller.
 *
 * @Route("consulta")
 */
class ConsultaController extends Controller {

    /**
     * Lists all consultum entities.
     *
     * @Route("/", name="consulta_index")
     * @Method("GET")
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();
        $consultas = $em->getRepository('AppBundle:Consulta')->findAll();
        return $this->render('consulta/index.html.twig', array(
                    'consultas' => $consultas,
        ));
    }

    /**
     * Dar de alta la consulta.
     *
     * @Route("/alta", name="consulta_alta")
     * @Method({"POST"})
     */
    public function altaAction(Request $request) {
        $id = $request->request->get('alta_consulta');
        $em = $this->getDoctrine()->getManager();
        $consulta = $em->getRepository('AppBundle:Consulta')->find($id);
        $consulta->setEgreso(TRUE);

        //Verificamos si la Consulta fue dada por una Cita planificada en la especialidad seleccionada
        $hoy = new \DateTime('now');
        $hoy->setTime(0, 0, 0);
        $cita = $em->getRepository('AppBundle:Cita')->findOneBy(
                array(
                    'paciente' => $consulta->getPaciente(),
                    'fecha' => $hoy,
                    'especialidad' => $consulta->getEspecialidad(),
                    'status' => 'activo',
                )
        );

        // A la Cita le cambiamos el Estatus a procesada
        if ($cita != null && $cita->getConsulta() != $consulta) {
            $cita->setStatus('procesada');
            $em->persist($cita);
            $em->flush($cita);
        }

        //Verificamos si se generaron Reposos y Constancias para Enviar los Email Respectivos
        $reposos = $em->getRepository('AppBundle:Reposo')->findByConsulta($consulta);
        $constancias = $em->getRepository('AppBundle:Constancia')->findByConsulta($consulta);
        //  foreach ($reposos as &reposo ) {

/*      enviar CORREOS  */


        //Actualizamos la Consulta
        $em->persist($consulta);
        $em->flush($consulta);

        return $this->redirectToRoute('homepage_medico');
    }

    /**
     * Crear nueva consulta.
     *
     * @Route("/new", name="consulta_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request) {

        $consultum = new Consulta();
        if ($this->getUser()->getRoles()[0] == 'ROLE_MEDICO') {
            $em = $this->getDoctrine()->getManager();

            $profesional = $em->getRepository('AppBundle:Profesional')->findOneByPersona($this->getUser()->getPersona());
            $consultum->setEgreso(FALSE);
            $consultum->setProfesional($profesional);
            //Buscamos todos los servicios asociado al profesional
            $servicioProfesional = $em->getRepository('AppBundle:ServicioProfesional')->findBy(array('profesional' => $profesional, 'status' => 'activo'));
            //Verificamos si el profesional tiene asociado un servicio para hoy
            foreach ($servicioProfesional as &$valor) {
                if (($valor->getServicio()->getDia() == date("w"))) {
                  $consultum->setEspecialidad($valor->getServicio()->getEspecialidad());  
                }
            }            
            $consultum->setFecha(new \DateTime("now"));            
            //dump($consultum);die();
        }
        $form = $this->createForm('AppBundle\Form\ConsultaType', $consultum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($consultum);
            $em->flush($consultum);
            return $this->redirectToRoute('homepage_consulta', array(
                        'paciente' => $consultum->getPaciente()->getId(),
            ));

            return $this->redirectToRoute('consulta_show', array('id' => $consultum->getId()));
        }

        return $this->render('consulta/new.html.twig', array(
                    'consultum' => $consultum,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a consultum entity.
     *
     * @Route("/{id}", name="consulta_show")
     * @Method("GET")
     */
    public function showAction(Consulta $consultum) {
        $deleteForm = $this->createDeleteForm($consultum);

        return $this->render('consulta/show.html.twig', array(
                    'consultum' => $consultum,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing consultum entity.
     *
     * @Route("/{id}/edit", name="consulta_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Consulta $consultum) {
        $deleteForm = $this->createDeleteForm($consultum);
        $editForm = $this->createForm('AppBundle\Form\ConsultaType', $consultum);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('consulta_edit', array('id' => $consultum->getId()));
        }

        return $this->render('consulta/edit.html.twig', array(
                    'consultum' => $consultum,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a consultum entity.
     *
     * @Route("/{id}", name="consulta_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Consulta $consultum) {
        $form = $this->createDeleteForm($consultum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($consultum);
            $em->flush($consultum);
        }

        return $this->redirectToRoute('consulta_index');
    }

    /**
     * Creates a form to delete a consultum entity.
     *
     * @param Consulta $consultum The consultum entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Consulta $consultum) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('consulta_delete', array('id' => $consultum->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}

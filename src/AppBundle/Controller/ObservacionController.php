<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Observacion;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Observacion controller.
 *
 * @Route("observacion")
 */
class ObservacionController extends Controller {

    /**
     * Lists all observacion entities.
     *
     * @Route("/", name="observacion_index")
     * @Method("GET")
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $observacions = $em->getRepository('AppBundle:Observacion')->findAll();

        return $this->render('observacion/index.html.twig', array(
                    'observacions' => $observacions,
        ));
    }

    /**
     * Creates a new observacion entity.
     *
     * @Route("/new", name="observacion_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $consulta = NULL;


        if ($request->request->get('observacion_consulta')) {
            $consulta = $em->getRepository('AppBundle:Consulta')->find($request->request->get('observacion_consulta'));
        }
        //dump($consulta);die();
        $observacion = new Observacion();
        if ($consulta) {
            $observacion->setConsulta($consulta);
            $observacion->setFecha(new \DateTime('now'));
            $observacion->setUsuario($this->getUser());
        }
        $form = $this->createForm('AppBundle\Form\ObservacionType', $observacion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($observacion);
            $em->flush($observacion);
            $this->addFlash('success', 'Observación registrado satisfactoriamente');
            return $this->redirectToRoute('homepage_enfermeria', array(
                        'paciente' => $observacion->getConsulta()->getPaciente()->getId(),
            ));
        }

        return $this->render('observacion/new.html.twig', array(
                    'observacion' => $observacion,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a observacion entity.
     *
     * @Route("/{id}", name="observacion_show")
     * @Method("GET")
     */
    public function showAction(Observacion $observacion) {
        $deleteForm = $this->createDeleteForm($observacion);

        return $this->render('observacion/show.html.twig', array(
                    'observacion' => $observacion,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing observacion entity.
     *
     * @Route("/{id}/edit", name="observacion_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Observacion $observacion) {
        $deleteForm = $this->createDeleteForm($observacion);
        $editForm = $this->createForm('AppBundle\Form\ObservacionType', $observacion);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'Observación actualizado satisfactoriamente');
            return $this->redirectToRoute('homepage_enfermeria', array(
                        'paciente' => $observacion->getConsulta()->getPaciente()->getId()));
        }

        return $this->render('observacion/edit.html.twig', array(
                    'observacion' => $observacion,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a observacion entity.
     *
     * @Route("/{id}", name="observacion_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Observacion $observacion) {
        $form = $this->createDeleteForm($observacion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($observacion);
            $em->flush($observacion);
        }

        $this->addFlash('success', 'Observación actualizado satisfactoriamente');
            return $this->redirectToRoute('homepage_enfermeria', array(
                        'paciente' => $observacion->getConsulta()->getPaciente()->getId()));
    }

    /**
     * Creates a form to delete a observacion entity.
     *
     * @param Observacion $observacion The observacion entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Observacion $observacion) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('observacion_delete', array('id' => $observacion->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}

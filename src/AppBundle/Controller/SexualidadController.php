<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Sexualidad;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Sexualidad controller.
 *
 * @Route("sexualidad")
 */
class SexualidadController extends Controller {

    /**
     * Lists all sexualidad entities.
     *
     * @Route("/", name="sexualidad_index")
     * @Method("GET")
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();
        $sexualidads = $em->getRepository('AppBundle:Sexualidad')->findAll();
        return $this->render('sexualidad/index.html.twig', array(
                    'sexualidads' => $sexualidads,
        ));
    }

    /**
     * Creates a new sexualidad entity.
     *
     * @Route("/new", name="sexualidad_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request) {
        $sexualidad = new Sexualidad();
        $form = $this->createForm('AppBundle\Form\SexualidadType', $sexualidad);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $paciente = $em->getRepository('AppBundle:Paciente')->find($request->request->get('III_paciente'));            
            
            $sexualidad->setPaciente($paciente);
            $sexualidad->setFechaRegistro(new \DateTime("now"));
            $em->persist($sexualidad);
            $em->flush($sexualidad);

        return $this->redirectToRoute('paciente_show', array('id' => $sexualidad->getPaciente()->getId()));
        }

        return $this->render('sexualidad/new.html.twig', array(
                    'sexualidad' => $sexualidad,
                    'form' => $form->createView(),
                    'III_paciente' => $request->get('III_paciente')
        ));
    }

    /**
     * Finds and displays a sexualidad entity.
     *
     * @Route("/{id}", name="sexualidad_show")
     * @Method("GET")
     */
    public function showAction(Sexualidad $sexualidad) {
        $deleteForm = $this->createDeleteForm($sexualidad);

        return $this->render('sexualidad/show.html.twig', array(
                    'sexualidad' => $sexualidad,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing sexualidad entity.
     *
     * @Route("/{id}/edit", name="sexualidad_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Sexualidad $sexualidad) {
        $deleteForm = $this->createDeleteForm($sexualidad);
        $editForm = $this->createForm('AppBundle\Form\SexualidadType', $sexualidad);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $sexualidad->setFechaActualizacion(new \DateTime("now"));
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Datos actualizados satisfactoriamente');

            return $this->redirectToRoute('paciente_show', array('id' => $sexualidad->getPaciente()->getId()));
        }

        return $this->render('sexualidad/edit.html.twig', array(
                    'sexualidad' => $sexualidad,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a sexualidad entity.
     *
     * @Route("/{id}", name="sexualidad_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Sexualidad $sexualidad) {
        $form = $this->createDeleteForm($sexualidad);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($sexualidad);
            $em->flush($sexualidad);
        }

        return $this->redirectToRoute('paciente_index');
    }

    /**
     * Creates a form to delete a sexualidad entity.
     *
     * @param Sexualidad $sexualidad The sexualidad entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Sexualidad $sexualidad) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('sexualidad_delete', array('id' => $sexualidad->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}

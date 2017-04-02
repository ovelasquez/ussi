<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ServicioProfesional;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Servicioprofesional controller.
 *
 * @Route("servicioprofesional")
 */
class ServicioProfesionalController extends Controller
{
    /**
     * Lists all servicioProfesional entities.
     *
     * @Route("/", name="servicioprofesional_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $servicioProfesionals = $em->getRepository('AppBundle:ServicioProfesional')->findAll();

        return $this->render('servicioprofesional/index.html.twig', array(
            'servicioProfesionals' => $servicioProfesionals,
        ));
    }

    /**
     * Creates a new servicioProfesional entity.
     *
     * @Route("/new", name="servicioprofesional_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $servicioProfesional = new Servicioprofesional();
        $form = $this->createForm('AppBundle\Form\ServicioProfesionalType', $servicioProfesional);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($servicioProfesional);
            $em->flush($servicioProfesional);
            $this->addFlash('success', 'Datos creados satisfactoriamente');

            return $this->redirectToRoute('servicioprofesional_show', array('id' => $servicioProfesional->getId()));
        }

        return $this->render('servicioprofesional/new.html.twig', array(
            'servicioProfesional' => $servicioProfesional,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a servicioProfesional entity.
     *
     * @Route("/{id}", name="servicioprofesional_show")
     * @Method("GET")
     */
    public function showAction(ServicioProfesional $servicioProfesional)
    {
        $deleteForm = $this->createDeleteForm($servicioProfesional);

        return $this->render('servicioprofesional/show.html.twig', array(
            'servicioProfesional' => $servicioProfesional,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing servicioProfesional entity.
     *
     * @Route("/{id}/edit", name="servicioprofesional_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ServicioProfesional $servicioProfesional)
    {
        $deleteForm = $this->createDeleteForm($servicioProfesional);
        $editForm = $this->createForm('AppBundle\Form\ServicioProfesionalType', $servicioProfesional);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $servicioProfesional->setFechaActualizacion(new \DateTime("now"));
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Datos actualizados satisfactoriamente');

            return $this->redirectToRoute('servicioprofesional_show', array('id' => $servicioProfesional->getId()));
        }

        return $this->render('servicioprofesional/edit.html.twig', array(
            'servicioProfesional' => $servicioProfesional,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a servicioProfesional entity.
     *
     * @Route("/{id}", name="servicioprofesional_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ServicioProfesional $servicioProfesional)
    {
        $form = $this->createDeleteForm($servicioProfesional);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($servicioProfesional);
            $em->flush($servicioProfesional);
        }

        return $this->redirectToRoute('servicioprofesional_index');
    }

    /**
     * Creates a form to delete a servicioProfesional entity.
     *
     * @param ServicioProfesional $servicioProfesional The servicioProfesional entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ServicioProfesional $servicioProfesional)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('servicioprofesional_delete', array('id' => $servicioProfesional->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

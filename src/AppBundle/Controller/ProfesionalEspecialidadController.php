<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ProfesionalEspecialidad;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Profesionalespecialidad controller.
 *
 * @Route("profesionalespecialidad")
 */
class ProfesionalEspecialidadController extends Controller
{
    /**
     * Lists all profesionalEspecialidad entities.
     *
     * @Route("/", name="profesionalespecialidad_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $profesionalEspecialidads = $em->getRepository('AppBundle:ProfesionalEspecialidad')->findAll();

        return $this->render('profesionalespecialidad/index.html.twig', array(
            'profesionalEspecialidads' => $profesionalEspecialidads,
        ));
    }

    /**
     * Creates a new profesionalEspecialidad entity.
     *
     * @Route("/new", name="profesionalespecialidad_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $profesionalEspecialidad = new Profesionalespecialidad();
        $form = $this->createForm('AppBundle\Form\ProfesionalEspecialidadType', $profesionalEspecialidad);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($profesionalEspecialidad);
            $em->flush($profesionalEspecialidad);

            return $this->redirectToRoute('profesionalespecialidad_show', array('id' => $profesionalEspecialidad->getId()));
        }

        return $this->render('profesionalespecialidad/new.html.twig', array(
            'profesionalEspecialidad' => $profesionalEspecialidad,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a profesionalEspecialidad entity.
     *
     * @Route("/{id}", name="profesionalespecialidad_show")
     * @Method("GET")
     */
    public function showAction(ProfesionalEspecialidad $profesionalEspecialidad)
    {
        $deleteForm = $this->createDeleteForm($profesionalEspecialidad);

        return $this->render('profesionalespecialidad/show.html.twig', array(
            'profesionalEspecialidad' => $profesionalEspecialidad,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing profesionalEspecialidad entity.
     *
     * @Route("/{id}/edit", name="profesionalespecialidad_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ProfesionalEspecialidad $profesionalEspecialidad)
    {
        $deleteForm = $this->createDeleteForm($profesionalEspecialidad);
        $editForm = $this->createForm('AppBundle\Form\ProfesionalEspecialidadType', $profesionalEspecialidad);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('profesionalespecialidad_edit', array('id' => $profesionalEspecialidad->getId()));
        }

        return $this->render('profesionalespecialidad/edit.html.twig', array(
            'profesionalEspecialidad' => $profesionalEspecialidad,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a profesionalEspecialidad entity.
     *
     * @Route("/{id}", name="profesionalespecialidad_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ProfesionalEspecialidad $profesionalEspecialidad)
    {
        $form = $this->createDeleteForm($profesionalEspecialidad);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($profesionalEspecialidad);
            $em->flush($profesionalEspecialidad);
        }

        return $this->redirectToRoute('profesionalespecialidad_index');
    }

    /**
     * Creates a form to delete a profesionalEspecialidad entity.
     *
     * @param ProfesionalEspecialidad $profesionalEspecialidad The profesionalEspecialidad entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ProfesionalEspecialidad $profesionalEspecialidad)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('profesionalespecialidad_delete', array('id' => $profesionalEspecialidad->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

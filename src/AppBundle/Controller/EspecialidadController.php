<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Especialidad;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Especialidad controller.
 *
 * @Route("especialidad")
 */
class EspecialidadController extends Controller
{
    /**
     * Lists all especialidad entities.
     *
     * @Route("/", name="especialidad_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $especialidads = $em->getRepository('AppBundle:Especialidad')->findAll();

        return $this->render('especialidad/index.html.twig', array(
            'especialidads' => $especialidads,
        ));
    }

    /**
     * Creates a new especialidad entity.
     *
     * @Route("/new", name="especialidad_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $especialidad = new Especialidad();
        $form = $this->createForm('AppBundle\Form\EspecialidadType', $especialidad);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($especialidad);
            $em->flush($especialidad);

            return $this->redirectToRoute('especialidad_show', array('id' => $especialidad->getId()));
        }

        return $this->render('especialidad/new.html.twig', array(
            'especialidad' => $especialidad,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a especialidad entity.
     *
     * @Route("/{id}", name="especialidad_show")
     * @Method("GET")
     */
    public function showAction(Especialidad $especialidad)
    {
        $deleteForm = $this->createDeleteForm($especialidad);

        return $this->render('especialidad/show.html.twig', array(
            'especialidad' => $especialidad,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing especialidad entity.
     *
     * @Route("/{id}/edit", name="especialidad_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Especialidad $especialidad)
    {
        $deleteForm = $this->createDeleteForm($especialidad);
        $editForm = $this->createForm('AppBundle\Form\EspecialidadType', $especialidad);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('especialidad_edit', array('id' => $especialidad->getId()));
        }

        return $this->render('especialidad/edit.html.twig', array(
            'especialidad' => $especialidad,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a especialidad entity.
     *
     * @Route("/{id}", name="especialidad_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Especialidad $especialidad)
    {
        $form = $this->createDeleteForm($especialidad);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($especialidad);
            $em->flush($especialidad);
        }

        return $this->redirectToRoute('especialidad_index');
    }

    /**
     * Creates a form to delete a especialidad entity.
     *
     * @param Especialidad $especialidad The especialidad entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Especialidad $especialidad)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('especialidad_delete', array('id' => $especialidad->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Tratamiento;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Tratamiento controller.
 *
 * @Route("tratamiento")
 */
class TratamientoController extends Controller
{
    /**
     * Lists all tratamiento entities.
     *
     * @Route("/", name="tratamiento_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tratamientos = $em->getRepository('AppBundle:Tratamiento')->findAll();

        return $this->render('tratamiento/index.html.twig', array(
            'tratamientos' => $tratamientos,
        ));
    }

    /**
     * Creates a new tratamiento entity.
     *
     * @Route("/new", name="tratamiento_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $tratamiento = new Tratamiento();
        $form = $this->createForm('AppBundle\Form\TratamientoType', $tratamiento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tratamiento);
            $em->flush($tratamiento);
            $this->addFlash('success', 'Tratamiento registrado satisfactoriamente');

            return $this->redirectToRoute('tratamiento_show', array('id' => $tratamiento->getId()));
        }

        return $this->render('tratamiento/new.html.twig', array(
            'tratamiento' => $tratamiento,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a tratamiento entity.
     *
     * @Route("/{id}", name="tratamiento_show")
     * @Method("GET")
     */
    public function showAction(Tratamiento $tratamiento)
    {
        $deleteForm = $this->createDeleteForm($tratamiento);

        return $this->render('tratamiento/show.html.twig', array(
            'tratamiento' => $tratamiento,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing tratamiento entity.
     *
     * @Route("/{id}/edit", name="tratamiento_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Tratamiento $tratamiento)
    {
        $deleteForm = $this->createDeleteForm($tratamiento);
        $editForm = $this->createForm('AppBundle\Form\TratamientoType', $tratamiento);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'Tratamiento editado satisfactoriamente');
            return $this->redirectToRoute('tratamiento_show', array('id' => $tratamiento->getId()));
        }

        return $this->render('tratamiento/edit.html.twig', array(
            'tratamiento' => $tratamiento,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a tratamiento entity.
     *
     * @Route("/{id}", name="tratamiento_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Tratamiento $tratamiento)
    {
        $form = $this->createDeleteForm($tratamiento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tratamiento);
            $em->flush($tratamiento);
        }

        return $this->redirectToRoute('tratamiento_index');
    }

    /**
     * Creates a form to delete a tratamiento entity.
     *
     * @param Tratamiento $tratamiento The tratamiento entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Tratamiento $tratamiento)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tratamiento_delete', array('id' => $tratamiento->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

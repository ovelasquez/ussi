<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Religion;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Religion controller.
 *
 * @Route("religion")
 */
class ReligionController extends Controller
{
    /**
     * Lists all religion entities.
     *
     * @Route("/", name="religion_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $religions = $em->getRepository('AppBundle:Religion')->findAll();

        return $this->render('religion/index.html.twig', array(
            'religions' => $religions,
        ));
    }

    /**
     * Creates a new religion entity.
     *
     * @Route("/new", name="religion_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $religion = new Religion();
        $form = $this->createForm('AppBundle\Form\ReligionType', $religion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($religion);
            $em->flush($religion);

            return $this->redirectToRoute('religion_show', array('id' => $religion->getId()));
        }

        return $this->render('religion/new.html.twig', array(
            'religion' => $religion,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a religion entity.
     *
     * @Route("/{id}", name="religion_show")
     * @Method("GET")
     */
    public function showAction(Religion $religion)
    {
        $deleteForm = $this->createDeleteForm($religion);

        return $this->render('religion/show.html.twig', array(
            'religion' => $religion,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing religion entity.
     *
     * @Route("/{id}/edit", name="religion_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Religion $religion)
    {
        $deleteForm = $this->createDeleteForm($religion);
        $editForm = $this->createForm('AppBundle\Form\ReligionType', $religion);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Datos actualizados satisfactoriamente');

            return $this->redirectToRoute('religion_show', array('id' => $religion->getId()));
        }

        return $this->render('religion/edit.html.twig', array(
            'religion' => $religion,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a religion entity.
     *
     * @Route("/{id}", name="religion_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Religion $religion)
    {
        $form = $this->createDeleteForm($religion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($religion);
            $em->flush($religion);
        }

        return $this->redirectToRoute('religion_index');
    }

    /**
     * Creates a form to delete a religion entity.
     *
     * @param Religion $religion The religion entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Religion $religion)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('religion_delete', array('id' => $religion->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

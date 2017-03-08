<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Etnia;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Etnium controller.
 *
 * @Route("etnia")
 */
class EtniaController extends Controller
{
    /**
     * Lists all etnium entities.
     *
     * @Route("/", name="etnia_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $etnias = $em->getRepository('AppBundle:Etnia')->findAll();

        return $this->render('etnia/index.html.twig', array(
            'etnias' => $etnias,
        ));
    }

    /**
     * Creates a new etnium entity.
     *
     * @Route("/new", name="etnia_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $etnium = new Etnia();
        $form = $this->createForm('AppBundle\Form\EtniaType', $etnium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($etnium);
            $em->flush($etnium);

            return $this->redirectToRoute('etnia_show', array('id' => $etnium->getId()));
        }

        return $this->render('etnia/new.html.twig', array(
            'etnium' => $etnium,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a etnium entity.
     *
     * @Route("/{id}", name="etnia_show")
     * @Method("GET")
     */
    public function showAction(Etnia $etnium)
    {
        $deleteForm = $this->createDeleteForm($etnium);

        return $this->render('etnia/show.html.twig', array(
            'etnium' => $etnium,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing etnium entity.
     *
     * @Route("/{id}/edit", name="etnia_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Etnia $etnium)
    {
        $deleteForm = $this->createDeleteForm($etnium);
        $editForm = $this->createForm('AppBundle\Form\EtniaType', $etnium);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Datos actualizados satisfactoriamente');

            return $this->redirectToRoute('etnia_show', array('id' => $etnium->getId()));
        }

        return $this->render('etnia/edit.html.twig', array(
            'etnium' => $etnium,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a etnium entity.
     *
     * @Route("/{id}", name="etnia_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Etnia $etnium)
    {
        $form = $this->createDeleteForm($etnium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($etnium);
            
            $em->flush($etnium);
        }

        return $this->redirectToRoute('etnia_index');
    }

    /**
     * Creates a form to delete a etnium entity.
     *
     * @param Etnia $etnium The etnium entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Etnia $etnium)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('etnia_delete', array('id' => $etnium->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

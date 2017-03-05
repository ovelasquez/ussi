<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Parroquia;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Parroquium controller.
 *
 * @Route("parroquia")
 */
class ParroquiaController extends Controller
{
    /**
     * Lists all parroquium entities.
     *
     * @Route("/", name="parroquia_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $parroquias = $em->getRepository('AppBundle:Parroquia')->findAll();

        return $this->render('parroquia/index.html.twig', array(
            'parroquias' => $parroquias,
        ));
    }

    /**
     * Creates a new parroquium entity.
     *
     * @Route("/new", name="parroquia_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $parroquium = new Parroquia();
        $form = $this->createForm('AppBundle\Form\ParroquiaType', $parroquium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($parroquium);
            $em->flush($parroquium);

            return $this->redirectToRoute('parroquia_show', array('id' => $parroquium->getId()));
        }

        return $this->render('parroquia/new.html.twig', array(
            'parroquium' => $parroquium,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a parroquium entity.
     *
     * @Route("/{id}", name="parroquia_show")
     * @Method("GET")
     */
    public function showAction(Parroquia $parroquium)
    {
        $deleteForm = $this->createDeleteForm($parroquium);

        return $this->render('parroquia/show.html.twig', array(
            'parroquium' => $parroquium,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing parroquium entity.
     *
     * @Route("/{id}/edit", name="parroquia_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Parroquia $parroquium)
    {
        $deleteForm = $this->createDeleteForm($parroquium);
        $editForm = $this->createForm('AppBundle\Form\ParroquiaType', $parroquium);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('parroquia_edit', array('id' => $parroquium->getId()));
        }

        return $this->render('parroquia/edit.html.twig', array(
            'parroquium' => $parroquium,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a parroquium entity.
     *
     * @Route("/{id}", name="parroquia_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Parroquia $parroquium)
    {
        $form = $this->createDeleteForm($parroquium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($parroquium);
            $em->flush($parroquium);
        }

        return $this->redirectToRoute('parroquia_index');
    }

    /**
     * Creates a form to delete a parroquium entity.
     *
     * @param Parroquia $parroquium The parroquium entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Parroquia $parroquium)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('parroquia_delete', array('id' => $parroquium->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

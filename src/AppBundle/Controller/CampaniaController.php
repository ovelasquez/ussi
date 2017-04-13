<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Campania;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Campanium controller.
 *
 * @Route("campania")
 */
class CampaniaController extends Controller {

    /**
     * Lists all campanium entities.
     *
     * @Route("/", name="campania_index")
     * @Method("GET")
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $campanias = $em->getRepository('AppBundle:Campania')->findAll();

        return $this->render('campania/index.html.twig', array(
                    'campanias' => $campanias,
        ));
    }

    /**
     * Creates a new campanium entity.
     *
     * @Route("/new", name="campania_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request) {
        $campanium = new Campania();
        $form = $this->createForm('AppBundle\Form\CampaniaType', $campanium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($campanium);
            $em->flush($campanium);

            return $this->redirectToRoute('campania_show', array('id' => $campanium->getId()));
        }

        return $this->render('campania/new.html.twig', array(
                    'campanium' => $campanium,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a campanium entity.
     *
     * @Route("/{id}", name="campania_show")
     * @Method("GET")
     */
    public function showAction(Campania $campanium) {
        $deleteForm = $this->createDeleteForm($campanium);
        $em = $this->getDoctrine()->getManager();
        // $imagens = $em->getRepository('AppBundle:Campania')->findAllByLasImagenes($campanium->getId());
        // dump($imagens); die();

        return $this->render('campania/show.html.twig', array(
                    'campanium' => $campanium,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing campanium entity.
     *
     * @Route("/{id}/edit", name="campania_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Campania $campanium) {

        $deleteForm = $this->createDeleteForm($campanium);
        $editForm = $this->createForm('AppBundle\Form\CampaniaType', $campanium);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('campania_show', array('id' => $campanium->getId()));
        }
        return $this->render('campania/edit.html.twig', array(
                    'campanium' => $campanium,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a campanium entity.
     *
     * @Route("/{id}", name="campania_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Campania $campanium) {
        $form = $this->createDeleteForm($campanium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($campanium);
            $em->flush($campanium);
        }

        return $this->redirectToRoute('campania_index');
    }

    /**
     * Creates a form to delete a campanium entity.
     *
     * @param Campania $campanium The campanium entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Campania $campanium) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('campania_delete', array('id' => $campanium->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}

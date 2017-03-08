<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Pfg;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Pfg controller.
 *
 * @Route("pfg")
 */
class PfgController extends Controller
{
    /**
     * Lists all pfg entities.
     *
     * @Route("/", name="pfg_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $pfgs = $em->getRepository('AppBundle:Pfg')->findAll();

        return $this->render('pfg/index.html.twig', array(
            'pfgs' => $pfgs,
        ));
    }

    /**
     * Creates a new pfg entity.
     *
     * @Route("/new", name="pfg_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $pfg = new Pfg();
        $form = $this->createForm('AppBundle\Form\PfgType', $pfg);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($pfg);
            $em->flush($pfg);

            return $this->redirectToRoute('pfg_show', array('id' => $pfg->getId()));
        }

        return $this->render('pfg/new.html.twig', array(
            'pfg' => $pfg,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a pfg entity.
     *
     * @Route("/{id}", name="pfg_show")
     * @Method("GET")
     */
    public function showAction(Pfg $pfg)
    {
        $deleteForm = $this->createDeleteForm($pfg);

        return $this->render('pfg/show.html.twig', array(
            'pfg' => $pfg,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing pfg entity.
     *
     * @Route("/{id}/edit", name="pfg_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Pfg $pfg)
    {
        $deleteForm = $this->createDeleteForm($pfg);
        $editForm = $this->createForm('AppBundle\Form\PfgType', $pfg);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Datos actualizados satisfactoriamente');

            return $this->redirectToRoute('pfg_show', array('id' => $pfg->getId()));
        }

        return $this->render('pfg/edit.html.twig', array(
            'pfg' => $pfg,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a pfg entity.
     *
     * @Route("/{id}", name="pfg_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Pfg $pfg)
    {
        $form = $this->createDeleteForm($pfg);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($pfg);
            $em->flush($pfg);
        }

        return $this->redirectToRoute('pfg_index');
    }

    /**
     * Creates a form to delete a pfg entity.
     *
     * @param Pfg $pfg The pfg entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Pfg $pfg)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('pfg_delete', array('id' => $pfg->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

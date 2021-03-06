<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Pais;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Pai controller.
 *
 * @Route("pais")
 */
class PaisController extends Controller
{
    /**
     * Lists all pai entities.
     *
     * @Route("/", name="pais_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $pais = $em->getRepository('AppBundle:Pais')->findAll();

        return $this->render('pais/index.html.twig', array(
            'pais' => $pais,
        ));
    }

    /**
     * Creates a new pai entity.
     *
     * @Route("/new", name="pais_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $pais = new Pais();
        $form = $this->createForm('AppBundle\Form\PaisType', $pais);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($pais);
            $em->flush($pais);
            $this->addFlash('success', 'Datos creados satisfactoriamente');

            return $this->redirectToRoute('pais_show', array('id' => $pais->getId()));
        }

        return $this->render('pais/new.html.twig', array(
            'pai' => $pais,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a pai entity.
     *
     * @Route("/{id}", name="pais_show")
     * @Method("GET")
     */
    public function showAction(Pais $pai)
    {
        $deleteForm = $this->createDeleteForm($pai);

        return $this->render('pais/show.html.twig', array(
            'pai' => $pai,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing pai entity.
     *
     * @Route("/{id}/edit", name="pais_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Pais $pai)
    {
        $deleteForm = $this->createDeleteForm($pai);
        $editForm = $this->createForm('AppBundle\Form\PaisType', $pai);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Datos actualizados satisfactoriamente');

            return $this->redirectToRoute('pais_show', array('id' => $pai->getId()));
        }

        return $this->render('pais/edit.html.twig', array(
            'pai' => $pai,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a pai entity.
     *
     * @Route("/{id}", name="pais_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Pais $pai)
    {
        $form = $this->createDeleteForm($pai);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($pai);
            $em->flush($pai);
        }

        return $this->redirectToRoute('pais_index');
    }

    /**
     * Creates a form to delete a pai entity.
     *
     * @param Pais $pai The pai entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Pais $pai)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('pais_delete', array('id' => $pai->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

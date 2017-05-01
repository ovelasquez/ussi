<?php

namespace AppBundle\Controller;

use AppBundle\Entity\TiposMedicamento;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Tiposmedicamento controller.
 *
 * @Route("tiposmedicamento")
 */
class TiposMedicamentoController extends Controller
{
    /**
     * Lists all tiposMedicamento entities.
     *
     * @Route("/", name="tiposmedicamento_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tiposMedicamentos = $em->getRepository('AppBundle:TiposMedicamento')->findAll();

        return $this->render('tiposmedicamento/index.html.twig', array(
            'tiposMedicamentos' => $tiposMedicamentos,
        ));
    }

    /**
     * Creates a new tiposMedicamento entity.
     *
     * @Route("/new", name="tiposmedicamento_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $tiposMedicamento = new Tiposmedicamento();
        $form = $this->createForm('AppBundle\Form\TiposMedicamentoType', $tiposMedicamento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tiposMedicamento);
            $em->flush($tiposMedicamento);

            return $this->redirectToRoute('tiposmedicamento_show', array('id' => $tiposMedicamento->getId()));
        }

        return $this->render('tiposmedicamento/new.html.twig', array(
            'tiposMedicamento' => $tiposMedicamento,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a tiposMedicamento entity.
     *
     * @Route("/{id}", name="tiposmedicamento_show")
     * @Method("GET")
     */
    public function showAction(TiposMedicamento $tiposMedicamento)
    {
        $deleteForm = $this->createDeleteForm($tiposMedicamento);

        return $this->render('tiposmedicamento/show.html.twig', array(
            'tiposMedicamento' => $tiposMedicamento,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing tiposMedicamento entity.
     *
     * @Route("/{id}/edit", name="tiposmedicamento_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, TiposMedicamento $tiposMedicamento)
    {
        $deleteForm = $this->createDeleteForm($tiposMedicamento);
        $editForm = $this->createForm('AppBundle\Form\TiposMedicamentoType', $tiposMedicamento);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tiposmedicamento_edit', array('id' => $tiposMedicamento->getId()));
        }

        return $this->render('tiposmedicamento/edit.html.twig', array(
            'tiposMedicamento' => $tiposMedicamento,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a tiposMedicamento entity.
     *
     * @Route("/{id}", name="tiposmedicamento_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, TiposMedicamento $tiposMedicamento)
    {
        $form = $this->createDeleteForm($tiposMedicamento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tiposMedicamento);
            $em->flush($tiposMedicamento);
        }

        return $this->redirectToRoute('tiposmedicamento_index');
    }

    /**
     * Creates a form to delete a tiposMedicamento entity.
     *
     * @param TiposMedicamento $tiposMedicamento The tiposMedicamento entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(TiposMedicamento $tiposMedicamento)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tiposmedicamento_delete', array('id' => $tiposMedicamento->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

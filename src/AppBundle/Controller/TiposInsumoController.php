<?php

namespace AppBundle\Controller;

use AppBundle\Entity\TiposInsumo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Tiposinsumo controller.
 *
 * @Route("tiposinsumo")
 */
class TiposInsumoController extends Controller
{
    /**
     * Lists all tiposInsumo entities.
     *
     * @Route("/", name="tiposinsumo_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tiposInsumos = $em->getRepository('AppBundle:TiposInsumo')->findAll();

        return $this->render('tiposinsumo/index.html.twig', array(
            'tiposInsumos' => $tiposInsumos,
        ));
    }

    /**
     * Creates a new tiposInsumo entity.
     *
     * @Route("/new", name="tiposinsumo_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $tiposInsumo = new Tiposinsumo();
        $form = $this->createForm('AppBundle\Form\TiposInsumoType', $tiposInsumo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tiposInsumo);
            $em->flush($tiposInsumo);

            return $this->redirectToRoute('tiposinsumo_show', array('id' => $tiposInsumo->getId()));
        }

        return $this->render('tiposinsumo/new.html.twig', array(
            'tiposInsumo' => $tiposInsumo,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a tiposInsumo entity.
     *
     * @Route("/{id}", name="tiposinsumo_show")
     * @Method("GET")
     */
    public function showAction(TiposInsumo $tiposInsumo)
    {
        $deleteForm = $this->createDeleteForm($tiposInsumo);

        return $this->render('tiposinsumo/show.html.twig', array(
            'tiposInsumo' => $tiposInsumo,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing tiposInsumo entity.
     *
     * @Route("/{id}/edit", name="tiposinsumo_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, TiposInsumo $tiposInsumo)
    {
        $deleteForm = $this->createDeleteForm($tiposInsumo);
        $editForm = $this->createForm('AppBundle\Form\TiposInsumoType', $tiposInsumo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tiposinsumo_edit', array('id' => $tiposInsumo->getId()));
        }

        return $this->render('tiposinsumo/edit.html.twig', array(
            'tiposInsumo' => $tiposInsumo,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a tiposInsumo entity.
     *
     * @Route("/{id}", name="tiposinsumo_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, TiposInsumo $tiposInsumo)
    {
        $form = $this->createDeleteForm($tiposInsumo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tiposInsumo);
            $em->flush($tiposInsumo);
        }

        return $this->redirectToRoute('tiposinsumo_index');
    }

    /**
     * Creates a form to delete a tiposInsumo entity.
     *
     * @param TiposInsumo $tiposInsumo The tiposInsumo entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(TiposInsumo $tiposInsumo)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tiposinsumo_delete', array('id' => $tiposInsumo->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

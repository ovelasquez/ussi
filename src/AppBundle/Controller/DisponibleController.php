<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Disponible;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Disponible controller.
 *
 * @Route("disponible")
 */
class DisponibleController extends Controller
{
    /**
     * Lists all disponible entities.
     *
     * @Route("/", name="disponible_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $disponibles = $em->getRepository('AppBundle:Disponible')->findAll();

        return $this->render('disponible/index.html.twig', array(
            'disponibles' => $disponibles,
        ));
    }

    /**
     * Creates a new disponible entity.
     *
     * @Route("/new", name="disponible_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $disponible = new Disponible();
        $form = $this->createForm('AppBundle\Form\DisponibleType', $disponible);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($disponible);
            $em->flush($disponible);

            return $this->redirectToRoute('disponible_show', array('id' => $disponible->getId()));
        }

        return $this->render('disponible/new.html.twig', array(
            'disponible' => $disponible,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a disponible entity.
     *
     * @Route("/{id}", name="disponible_show")
     * @Method("GET")
     */
    public function showAction(Disponible $disponible)
    {
        $deleteForm = $this->createDeleteForm($disponible);

        return $this->render('disponible/show.html.twig', array(
            'disponible' => $disponible,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing disponible entity.
     *
     * @Route("/{id}/edit", name="disponible_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Disponible $disponible)
    {
        $deleteForm = $this->createDeleteForm($disponible);
        $editForm = $this->createForm('AppBundle\Form\DisponibleType', $disponible);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('disponible_edit', array('id' => $disponible->getId()));
        }

        return $this->render('disponible/edit.html.twig', array(
            'disponible' => $disponible,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a disponible entity.
     *
     * @Route("/{id}", name="disponible_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Disponible $disponible)
    {
        $form = $this->createDeleteForm($disponible);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($disponible);
            $em->flush($disponible);
        }

        return $this->redirectToRoute('disponible_index');
    }

    /**
     * Creates a form to delete a disponible entity.
     *
     * @param Disponible $disponible The disponible entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Disponible $disponible)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('disponible_delete', array('id' => $disponible->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

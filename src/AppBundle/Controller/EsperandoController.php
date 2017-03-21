<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Esperando;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Esperando controller.
 *
 * @Route("esperando")
 */
class EsperandoController extends Controller
{
    /**
     * Lists all esperando entities.
     *
     * @Route("/", name="esperando_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $esperandos = $em->getRepository('AppBundle:Esperando')->findAll();

        return $this->render('esperando/index.html.twig', array(
            'esperandos' => $esperandos,
        ));
    }

    /**
     * Creates a new esperando entity.
     *
     * @Route("/new", name="esperando_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $esperando = new Esperando();
        $form = $this->createForm('AppBundle\Form\EsperandoType', $esperando);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($esperando);
            $em->flush($esperando);

            return $this->redirectToRoute('esperando_show', array('id' => $esperando->getId()));
        }

        return $this->render('esperando/new.html.twig', array(
            'esperando' => $esperando,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a esperando entity.
     *
     * @Route("/{id}", name="esperando_show")
     * @Method("GET")
     */
    public function showAction(Esperando $esperando)
    {
        $deleteForm = $this->createDeleteForm($esperando);

        return $this->render('esperando/show.html.twig', array(
            'esperando' => $esperando,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing esperando entity.
     *
     * @Route("/{id}/edit", name="esperando_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Esperando $esperando)
    {
        $deleteForm = $this->createDeleteForm($esperando);
        $editForm = $this->createForm('AppBundle\Form\EsperandoType', $esperando);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('esperando_edit', array('id' => $esperando->getId()));
        }

        return $this->render('esperando/edit.html.twig', array(
            'esperando' => $esperando,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a esperando entity.
     *
     * @Route("/{id}", name="esperando_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Esperando $esperando)
    {
        $form = $this->createDeleteForm($esperando);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($esperando);
            $em->flush($esperando);
        }

        return $this->redirectToRoute('esperando_index');
    }

    /**
     * Creates a form to delete a esperando entity.
     *
     * @param Esperando $esperando The esperando entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Esperando $esperando)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('esperando_delete', array('id' => $esperando->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

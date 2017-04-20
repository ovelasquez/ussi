<?php

namespace AppBundle\Controller;

use AppBundle\Entity\EntericaElemento;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Entericaelemento controller.
 *
 * @Route("entericaelemento")
 */
class EntericaElementoController extends Controller
{
    /**
     * Lists all entericaElemento entities.
     *
     * @Route("/", name="entericaelemento_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entericaElementos = $em->getRepository('AppBundle:EntericaElemento')->findAll();

        return $this->render('entericaelemento/index.html.twig', array(
            'entericaElementos' => $entericaElementos,
        ));
    }

    /**
     * Creates a new entericaElemento entity.
     *
     * @Route("/new", name="entericaelemento_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $entericaElemento = new Entericaelemento();
        $form = $this->createForm('AppBundle\Form\EntericaElementoType', $entericaElemento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entericaElemento);
            $em->flush($entericaElemento);

            return $this->redirectToRoute('entericaelemento_show', array('id' => $entericaElemento->getId()));
        }

        return $this->render('entericaelemento/new.html.twig', array(
            'entericaElemento' => $entericaElemento,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a entericaElemento entity.
     *
     * @Route("/{id}", name="entericaelemento_show")
     * @Method("GET")
     */
    public function showAction(EntericaElemento $entericaElemento)
    {
        $deleteForm = $this->createDeleteForm($entericaElemento);

        return $this->render('entericaelemento/show.html.twig', array(
            'entericaElemento' => $entericaElemento,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing entericaElemento entity.
     *
     * @Route("/{id}/edit", name="entericaelemento_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, EntericaElemento $entericaElemento)
    {
        $deleteForm = $this->createDeleteForm($entericaElemento);
        $editForm = $this->createForm('AppBundle\Form\EntericaElementoType', $entericaElemento);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('entericaelemento_edit', array('id' => $entericaElemento->getId()));
        }

        return $this->render('entericaelemento/edit.html.twig', array(
            'entericaElemento' => $entericaElemento,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a entericaElemento entity.
     *
     * @Route("/{id}", name="entericaelemento_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, EntericaElemento $entericaElemento)
    {
        $form = $this->createDeleteForm($entericaElemento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($entericaElemento);
            $em->flush($entericaElemento);
        }

        return $this->redirectToRoute('entericaelemento_index');
    }

    /**
     * Creates a form to delete a entericaElemento entity.
     *
     * @param EntericaElemento $entericaElemento The entericaElemento entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(EntericaElemento $entericaElemento)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('entericaelemento_delete', array('id' => $entericaElemento->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

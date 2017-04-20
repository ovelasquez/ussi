<?php

namespace AppBundle\Controller;

use AppBundle\Entity\EntericaCapitulo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Entericacapitulo controller.
 *
 * @Route("entericacapitulo")
 */
class EntericaCapituloController extends Controller
{
    /**
     * Lists all entericaCapitulo entities.
     *
     * @Route("/", name="entericacapitulo_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entericaCapitulos = $em->getRepository('AppBundle:EntericaCapitulo')->findAll();

        return $this->render('entericacapitulo/index.html.twig', array(
            'entericaCapitulos' => $entericaCapitulos,
        ));
    }

    /**
     * Creates a new entericaCapitulo entity.
     *
     * @Route("/new", name="entericacapitulo_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $entericaCapitulo = new Entericacapitulo();
        $form = $this->createForm('AppBundle\Form\EntericaCapituloType', $entericaCapitulo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entericaCapitulo);
            $em->flush($entericaCapitulo);

            return $this->redirectToRoute('entericacapitulo_show', array('id' => $entericaCapitulo->getId()));
        }

        return $this->render('entericacapitulo/new.html.twig', array(
            'entericaCapitulo' => $entericaCapitulo,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a entericaCapitulo entity.
     *
     * @Route("/{id}", name="entericacapitulo_show")
     * @Method("GET")
     */
    public function showAction(EntericaCapitulo $entericaCapitulo)
    {
        $deleteForm = $this->createDeleteForm($entericaCapitulo);

        return $this->render('entericacapitulo/show.html.twig', array(
            'entericaCapitulo' => $entericaCapitulo,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing entericaCapitulo entity.
     *
     * @Route("/{id}/edit", name="entericacapitulo_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, EntericaCapitulo $entericaCapitulo)
    {
        $deleteForm = $this->createDeleteForm($entericaCapitulo);
        $editForm = $this->createForm('AppBundle\Form\EntericaCapituloType', $entericaCapitulo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('entericacapitulo_edit', array('id' => $entericaCapitulo->getId()));
        }

        return $this->render('entericacapitulo/edit.html.twig', array(
            'entericaCapitulo' => $entericaCapitulo,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a entericaCapitulo entity.
     *
     * @Route("/{id}", name="entericacapitulo_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, EntericaCapitulo $entericaCapitulo)
    {
        $form = $this->createDeleteForm($entericaCapitulo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($entericaCapitulo);
            $em->flush($entericaCapitulo);
        }

        return $this->redirectToRoute('entericacapitulo_index');
    }

    /**
     * Creates a form to delete a entericaCapitulo entity.
     *
     * @param EntericaCapitulo $entericaCapitulo The entericaCapitulo entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(EntericaCapitulo $entericaCapitulo)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('entericacapitulo_delete', array('id' => $entericaCapitulo->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

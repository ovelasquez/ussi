<?php

namespace AppBundle\Controller;

use AppBundle\Entity\EntericaGrupo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Entericagrupo controller.
 *
 * @Route("entericagrupo")
 */
class EntericaGrupoController extends Controller
{
    /**
     * Lists all entericaGrupo entities.
     *
     * @Route("/", name="entericagrupo_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entericaGrupos = $em->getRepository('AppBundle:EntericaGrupo')->findAll();

        return $this->render('entericagrupo/index.html.twig', array(
            'entericaGrupos' => $entericaGrupos,
        ));
    }

    /**
     * Creates a new entericaGrupo entity.
     *
     * @Route("/new", name="entericagrupo_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $entericaGrupo = new Entericagrupo();
        $form = $this->createForm('AppBundle\Form\EntericaGrupoType', $entericaGrupo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entericaGrupo);
            $em->flush($entericaGrupo);

            return $this->redirectToRoute('entericagrupo_show', array('id' => $entericaGrupo->getId()));
        }

        return $this->render('entericagrupo/new.html.twig', array(
            'entericaGrupo' => $entericaGrupo,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a entericaGrupo entity.
     *
     * @Route("/{id}", name="entericagrupo_show")
     * @Method("GET")
     */
    public function showAction(EntericaGrupo $entericaGrupo)
    {
        $deleteForm = $this->createDeleteForm($entericaGrupo);

        return $this->render('entericagrupo/show.html.twig', array(
            'entericaGrupo' => $entericaGrupo,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing entericaGrupo entity.
     *
     * @Route("/{id}/edit", name="entericagrupo_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, EntericaGrupo $entericaGrupo)
    {
        $deleteForm = $this->createDeleteForm($entericaGrupo);
        $editForm = $this->createForm('AppBundle\Form\EntericaGrupoType', $entericaGrupo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('entericagrupo_edit', array('id' => $entericaGrupo->getId()));
        }

        return $this->render('entericagrupo/edit.html.twig', array(
            'entericaGrupo' => $entericaGrupo,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a entericaGrupo entity.
     *
     * @Route("/{id}", name="entericagrupo_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, EntericaGrupo $entericaGrupo)
    {
        $form = $this->createDeleteForm($entericaGrupo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($entericaGrupo);
            $em->flush($entericaGrupo);
        }

        return $this->redirectToRoute('entericagrupo_index');
    }

    /**
     * Creates a form to delete a entericaGrupo entity.
     *
     * @param EntericaGrupo $entericaGrupo The entericaGrupo entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(EntericaGrupo $entericaGrupo)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('entericagrupo_delete', array('id' => $entericaGrupo->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

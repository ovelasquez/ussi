<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Imagen;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Imagen controller.
 *
 * @Route("imagen")
 */
class ImagenController extends Controller
{
    /**
     * Lists all imagen entities.
     *
     * @Route("/", name="imagen_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $imagens = $em->getRepository('AppBundle:Imagen')->findAll();

        return $this->render('imagen/index.html.twig', array(
            'imagens' => $imagens,
        ));
    }

    /**
     * Creates a new imagen entity.
     *
     * @Route("/new", name="imagen_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $imagen = new Imagen();
        $form = $this->createForm('AppBundle\Form\ImagenType', $imagen);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($imagen);
            $em->flush($imagen);

            return $this->redirectToRoute('imagen_show', array('id' => $imagen->getId()));
        }

        return $this->render('imagen/new.html.twig', array(
            'imagen' => $imagen,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a imagen entity.
     *
     * @Route("/{id}", name="imagen_show")
     * @Method("GET")
     */
    public function showAction(Imagen $imagen)
    {
        $deleteForm = $this->createDeleteForm($imagen);

        return $this->render('imagen/show.html.twig', array(
            'imagen' => $imagen,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing imagen entity.
     *
     * @Route("/{id}/edit", name="imagen_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Imagen $imagen)
    {
        $deleteForm = $this->createDeleteForm($imagen);
        $editForm = $this->createForm('AppBundle\Form\ImagenType', $imagen);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('imagen_edit', array('id' => $imagen->getId()));
        }

        return $this->render('imagen/edit.html.twig', array(
            'imagen' => $imagen,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a imagen entity.
     *
     * @Route("/{id}", name="imagen_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Imagen $imagen)
    {
        $form = $this->createDeleteForm($imagen);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($imagen);
            $em->flush($imagen);
        }

        return $this->redirectToRoute('imagen_index');
    }

    /**
     * Creates a form to delete a imagen entity.
     *
     * @param Imagen $imagen The imagen entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Imagen $imagen)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('imagen_delete', array('id' => $imagen->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

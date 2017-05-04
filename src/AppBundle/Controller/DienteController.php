<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Diente;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Diente controller.
 *
 * @Route("diente")
 */
class DienteController extends Controller
{
    /**
     * Lists all diente entities.
     *
     * @Route("/", name="diente_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $dientes = $em->getRepository('AppBundle:Diente')->findAll();

        return $this->render('diente/index.html.twig', array(
            'dientes' => $dientes,
        ));
    }

    /**
     * Creates a new diente entity.
     *
     * @Route("/new", name="diente_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $diente = new Diente();
        $form = $this->createForm('AppBundle\Form\DienteType', $diente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($diente);
            $em->flush($diente);

            return $this->redirectToRoute('diente_show', array('id' => $diente->getId()));
        }
        
        $this->addFlash('success', 'Diente registrado satisfactoriamente');

        return $this->render('diente/show.html.twig', array(
            'diente' => $diente,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a diente entity.
     *
     * @Route("/{id}", name="diente_show")
     * @Method("GET")
     */
    public function showAction(Diente $diente)
    {
        $deleteForm = $this->createDeleteForm($diente);

        return $this->render('diente/show.html.twig', array(
            'diente' => $diente,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing diente entity.
     *
     * @Route("/{id}/edit", name="diente_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Diente $diente)
    {
        $deleteForm = $this->createDeleteForm($diente);
        $editForm = $this->createForm('AppBundle\Form\DienteType', $diente);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            
            $this->addFlash('success', 'Diente registrado satisfactoriamente');

            return $this->redirectToRoute('diente_show', array('id' => $diente->getId()));
        }

        return $this->render('diente/edit.html.twig', array(
            'diente' => $diente,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a diente entity.
     *
     * @Route("/{id}", name="diente_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Diente $diente)
    {
        $form = $this->createDeleteForm($diente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($diente);
            $em->flush($diente);
        }

        return $this->redirectToRoute('diente_index');
    }

    /**
     * Creates a form to delete a diente entity.
     *
     * @param Diente $diente The diente entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Diente $diente)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('diente_delete', array('id' => $diente->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

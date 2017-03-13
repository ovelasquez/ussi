<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Consulta;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Consultum controller.
 *
 * @Route("consulta")
 */
class ConsultaController extends Controller
{
    /**
     * Lists all consultum entities.
     *
     * @Route("/", name="consulta_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $consultas = $em->getRepository('AppBundle:Consulta')->findAll();

        return $this->render('consulta/index.html.twig', array(
            'consultas' => $consultas,
        ));
    }

    /**
     * Creates a new consultum entity.
     *
     * @Route("/new", name="consulta_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $consulta = new Consulta();
        $form = $this->createForm('AppBundle\Form\ConsultaType', $consulta);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($consulta);
            $em->flush($consulta);

            return $this->redirectToRoute('consulta_show', array('id' => $consulta->getId()));
        }

        return $this->render('consulta/new.html.twig', array(
            'consultum' => $consulta,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a consultum entity.
     *
     * @Route("/{id}", name="consulta_show")
     * @Method("GET")
     */
    public function showAction(Consulta $consulta)
    {
        $deleteForm = $this->createDeleteForm($consulta);

        return $this->render('consulta/show.html.twig', array(
            'consultum' => $consulta,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing consultum entity.
     *
     * @Route("/{id}/edit", name="consulta_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Consulta $consulta)
    {
        $deleteForm = $this->createDeleteForm($consulta);
        $editForm = $this->createForm('AppBundle\Form\ConsultaType', $consulta);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('consulta_edit', array('id' => $consulta->getId()));
        }

        return $this->render('consulta/edit.html.twig', array(
            'consultum' => $consulta,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a consultum entity.
     *
     * @Route("/{id}", name="consulta_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Consulta $consulta)
    {
        $form = $this->createDeleteForm($consulta);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($consulta);
            $em->flush($consulta);
        }

        return $this->redirectToRoute('consulta_index');
    }

    /**
     * Creates a form to delete a consultum entity.
     *
     * @param Consulta $consulta The consultum entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Consulta $consulta)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('consulta_delete', array('id' => $consulta->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

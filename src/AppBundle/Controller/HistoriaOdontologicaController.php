<?php

namespace AppBundle\Controller;

use AppBundle\Entity\HistoriaOdontologica;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Historiaodontologica controller.
 *
 * @Route("historiaodontologica")
 */
class HistoriaOdontologicaController extends Controller {

    /**
     * Lists all historiaOdontologica entities.
     *
     * @Route("/", name="historiaodontologica_index")
     * @Method("GET")
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $historiaOdontologicas = $em->getRepository('AppBundle:HistoriaOdontologica')->findAll();

        return $this->render('historiaodontologica/index.html.twig', array(
                    'historiaOdontologicas' => $historiaOdontologicas,
        ));
    }

    /**
     * Creates a new historiaOdontologica entity.
     *
     * @Route("/new", name="historiaodontologica_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $historiaOdontologica = new Historiaodontologica();
        if ($request->request->get('info_paciente') !== null) {
            $paciente = $em->getRepository('AppBundle:Paciente')->find($request->request->get('info_paciente'));
            $historiaOdontologica->setPaciente($paciente);
        }


        $form = $this->createForm('AppBundle\Form\HistoriaOdontologicaType', $historiaOdontologica);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($historiaOdontologica);
            $em->flush($historiaOdontologica);
            $this->addFlash('success', 'Historia odontológica registrada satisfactoriamente');
            return $this->redirectToRoute('homepage_odontologia', array('paciente' => $historiaOdontologica->getPaciente()->getId(),));
        }

        return $this->render('historiaodontologica/new.html.twig', array(
                    'historiaOdontologica' => $historiaOdontologica,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a historiaOdontologica entity.
     *
     * @Route("/{id}", name="historiaodontologica_show")
     * @Method("GET")
     */
    public function showAction(HistoriaOdontologica $historiaOdontologica) {
        $deleteForm = $this->createDeleteForm($historiaOdontologica);

        return $this->render('historiaodontologica/show.html.twig', array(
                    'historiaOdontologica' => $historiaOdontologica,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing historiaOdontologica entity.
     *
     * @Route("/{id}/edit", name="historiaodontologica_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, HistoriaOdontologica $historiaOdontologica) {
        $deleteForm = $this->createDeleteForm($historiaOdontologica);
        $editForm = $this->createForm('AppBundle\Form\HistoriaOdontologicaType', $historiaOdontologica);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Historia odontológica actualizados satisfactoriamente');
            return $this->redirectToRoute('homepage_odontologia', array('paciente' => $historiaOdontologica->getPaciente()->getId(),));
        }

        return $this->render('historiaodontologica/edit.html.twig', array(
                    'historiaOdontologica' => $historiaOdontologica,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a historiaOdontologica entity.
     *
     * @Route("/{id}", name="historiaodontologica_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, HistoriaOdontologica $historiaOdontologica) {
        $form = $this->createDeleteForm($historiaOdontologica);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $id = $historiaOdontologica->getPaciente()->getId();
            $em->remove($historiaOdontologica);
            $em->flush($historiaOdontologica);
        }
        $this->addFlash('success', 'Historia odontológica eliminada satisfactoriamente');
        return $this->redirectToRoute('homepage_odontologia', array('paciente' => $id,));
    }

    /**
     * Creates a form to delete a historiaOdontologica entity.
     *
     * @param HistoriaOdontologica $historiaOdontologica The historiaOdontologica entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(HistoriaOdontologica $historiaOdontologica) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('historiaodontologica_delete', array('id' => $historiaOdontologica->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}

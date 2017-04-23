<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Constancia;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Constancium controller.
 *
 * @Route("constancia")
 */
class ConstanciaController extends Controller {

    /**
     * Lists all constancium entities.
     *
     * @Route("/", name="constancia_index")
     * @Method("GET")
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $constancias = $em->getRepository('AppBundle:Constancia')->findAll();

        return $this->render('constancia/index.html.twig', array(
                    'constancias' => $constancias,
        ));
    }

    /**
     * Creates a new constancium entity.
     *
     * @Route("/new", name="constancia_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $consulta = NULL;

        if ($request->request->get('constancia_consulta')) {
            $consulta = $em->getRepository('AppBundle:Consulta')->find($request->request->get('constancia_consulta'));
        }
        $constancium = new Constancia();
        if ($consulta) {
            $constancium->setConsulta($consulta);
            
        }


        $form = $this->createForm('AppBundle\Form\ConstanciaType', $constancium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $constancium->setCodigo(uniqid()); //Codigo de validacion unico
            $em = $this->getDoctrine()->getManager();
            $em->persist($constancium);
            $em->flush($constancium);

            return $this->redirectToRoute('homepage_consulta', array(
                        'paciente' => $constancium->getConsulta()->getPaciente()->getId(),
            ));
        }

        return $this->render('constancia/new.html.twig', array(
                    'constancium' => $constancium,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a constancium entity.
     *
     * @Route("/{id}", name="constancia_show")
     * @Method("GET")
     */
    public function showAction(Constancia $constancium) {
        $deleteForm = $this->createDeleteForm($constancium);

        return $this->render('constancia/show.html.twig', array(
                    'constancium' => $constancium,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing constancium entity.
     *
     * @Route("/{id}/edit", name="constancia_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Constancia $constancium) {
        $deleteForm = $this->createDeleteForm($constancium);
        $editForm = $this->createForm('AppBundle\Form\ConstanciaType', $constancium);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('homepage_consulta', array(
                        'paciente' => $constancium->getConsulta()->getPaciente()->getId(),
            ));
        }

        return $this->render('constancia/edit.html.twig', array(
                    'constancium' => $constancium,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a constancium entity.
     *
     * @Route("/{id}", name="constancia_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Constancia $constancium) {
        $form = $this->createDeleteForm($constancium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $id = $constancium->getConsulta()->getPaciente()->getId();
            $em->remove($constancium);
            $em->flush($constancium);
        }

       return $this->redirectToRoute('homepage_consulta', array(
                    'paciente' => $id,
        ));
    }

    /**
     * Creates a form to delete a constancium entity.
     *
     * @param Constancia $constancium The constancium entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Constancia $constancium) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('constancia_delete', array('id' => $constancium->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}

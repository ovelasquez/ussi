<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Reposo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Reposo controller.
 *
 * @Route("reposo")
 */
class ReposoController extends Controller {

    /**
     * Lists all reposo entities.
     *
     * @Route("/", name="reposo_index")
     * @Method("GET")
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $reposos = $em->getRepository('AppBundle:Reposo')->findAll();

        return $this->render('reposo/index.html.twig', array(
                    'reposos' => $reposos,
        ));
    }

    /**
     * Creates a new reposo entity.
     *
     * @Route("/new", name="reposo_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $configuracion = $em->getRepository('AppBundle:Configuracion')->findAll();
        $consulta = NULL;

        if ($request->request->get('reposo_consulta')) {
            $consulta = $em->getRepository('AppBundle:Consulta')->find($request->request->get('reposo_consulta'));
        }
        $reposo = new Reposo();

        if ($consulta) {
            $reposo->setConsulta($consulta);
             $reposo->setObservacion($configuracion[0]->getTemplateReposo());
        }


        $form = $this->createForm('AppBundle\Form\ReposoType', $reposo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reposo->setCodigo(uniqid()); //Codigo de validacion unico
            
            $em->persist($reposo);
            $em->flush($reposo);

            return $this->redirectToRoute('homepage_consulta', array(
                        'paciente' => $reposo->getConsulta()->getPaciente()->getId(),
            ));
        }

        return $this->render('reposo/new.html.twig', array(
                    'reposo' => $reposo,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a reposo entity.
     *
     * @Route("/{id}", name="reposo_show")
     * @Method("GET")
     */
    public function showAction(Reposo $reposo) {
        $deleteForm = $this->createDeleteForm($reposo);

        return $this->render('reposo/show.html.twig', array(
                    'reposo' => $reposo,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing reposo entity.
     *
     * @Route("/{id}/edit", name="reposo_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Reposo $reposo) {
        $deleteForm = $this->createDeleteForm($reposo);
        $editForm = $this->createForm('AppBundle\Form\ReposoType', $reposo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('homepage_consulta', array(
                        'paciente' => $reposo->getConsulta()->getPaciente()->getId(),
            ));
        }

        return $this->render('reposo/edit.html.twig', array(
                    'reposo' => $reposo,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a reposo entity.
     *
     * @Route("/{id}", name="reposo_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Reposo $reposo) {
        $form = $this->createDeleteForm($reposo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $id = $reposo->getConsulta()->getPaciente()->getId();
            $em->remove($reposo);
            $em->flush($reposo);
        }
        return $this->redirectToRoute('homepage_consulta', array(
                    'paciente' => $id,
        ));
    }

    /**
     * Creates a form to delete a reposo entity.
     *
     * @param Reposo $reposo The reposo entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Reposo $reposo) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('reposo_delete', array('id' => $reposo->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}

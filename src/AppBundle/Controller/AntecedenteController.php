<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Antecedente;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Antecedente controller.
 *
 * @Route("antecedente")
 */
class AntecedenteController extends Controller {

    /**
     * Lists all antecedente entities.
     *
     * @Route("/", name="antecedente_index")
     * @Method("GET")
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $antecedentes = $em->getRepository('AppBundle:Antecedente')->findAll();

        return $this->render('antecedente/index.html.twig', array(
                    'antecedentes' => $antecedentes,
        ));
    }

    /**
     * Creates a new antecedente entity.
     *     
     * @Route("/new", name="antecedente_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request) {
        $antecedente = new Antecedente();
        $form = $this->createForm('AppBundle\Form\AntecedenteType', $antecedente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {            
            $em = $this->getDoctrine()->getManager();
            $paciente = $em->getRepository('AppBundle:Paciente')->find($request->request->get('info_paciente'));
           
            $antecedente->setPaciente($paciente);
            $antecedente->setFechaRegistro(new \DateTime("now"));
            $em->persist($antecedente);
            $em->flush($antecedente);
            return $this->redirectToRoute('paciente_show', array('id' => $antecedente->getPaciente()->getId()));
        }

        return $this->render('antecedente/new.html.twig', array(
                    'antecedente' => $antecedente,
                    'form' => $form->createView(),
                    'info_paciente' => $request->request->get('info_paciente'))
        );
    }

    /**
     * Finds and displays a antecedente entity.
     *
     * @Route("/{id}", name="antecedente_show")
     * @Method("GET")
     */
    public function showAction(Antecedente $antecedente) {
        $deleteForm = $this->createDeleteForm($antecedente);

        return $this->render('antecedente/show.html.twig', array(
                    'antecedente' => $antecedente,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing antecedente entity.
     *
     * @Route("/{id}/edit", name="antecedente_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Antecedente $antecedente) {
        $deleteForm = $this->createDeleteForm($antecedente);
        $editForm = $this->createForm('AppBundle\Form\AntecedenteType', $antecedente);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $antecedente->setFechaActualizacion(new \DateTime("now"));
            $this->getDoctrine()->getManager()->flush(); 
            $this->addFlash('success', 'Datos actualizados satisfactoriamente');
            
            return $this->redirectToRoute('paciente_show', array('id' => $antecedente->getPaciente()->getId()));
        }
        return $this->render('antecedente/edit.html.twig', array(
                    'antecedente' => $antecedente,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a antecedente entity.
     *
     * @Route("/{id}", name="antecedente_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Antecedente $antecedente) {
        $form = $this->createDeleteForm($antecedente);
        $form->handleRequest($request);
        $paciente=$antecedente->getPaciente()->getId();
        

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($antecedente);
            $em->flush($antecedente);
        }

        return $this->redirectToRoute('paciente_show', array('id' => $paciente));        
    }

    /**
     * Creates a form to delete a antecedente entity.
     *
     * @param Antecedente $antecedente The antecedente entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Antecedente $antecedente) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('antecedente_delete', array('id' => $antecedente->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}

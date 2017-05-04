<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Perinatal;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Perinatal controller.
 *
 * @Route("perinatal")
 */
class PerinatalController extends Controller {

    /**
     * Lists all perinatal entities.
     *
     * @Route("/", name="perinatal_index")
     * @Method("GET")
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();
        $perinatals = $em->getRepository('AppBundle:Perinatal')->findAll();

        return $this->render('perinatal/index.html.twig', array(
                    'perinatals' => $perinatals,
        ));
    }

    /**
     * Creates a new perinatal entity.
     *
     * @Route("/new", name="perinatal_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $perinatal = new Perinatal();
        $form = $this->createForm('AppBundle\Form\PerinatalType', $perinatal);
        $form->handleRequest($request);
         $paciente = $em->getRepository('AppBundle:Paciente')->find($request->request->get('IV_paciente'));


        $perinatal->setPaciente($paciente);
        

        if ($form->isSubmitted() && $form->isValid()) {
            
           
            $perinatal->setFechaRegistro(new \DateTime("now"));
            $em->persist($perinatal);
            $em->flush($perinatal);
            
              return $this->redirectToRoute('homepage_consulta', array(
                        'paciente' => $perinatal->getPaciente()->getId(),
            )); 

           
        }

        return $this->render('perinatal/new.html.twig', array(
                    'perinatal' => $perinatal,
                    'form' => $form->createView(),
                    'IV_paciente' => $request->request->get('IV_paciente'))
        );
    }

    /**
     * Finds and displays a perinatal entity.
     *
     * @Route("/{id}", name="perinatal_show")
     * @Method("GET")
     */
    public function showAction(Perinatal $perinatal) {
        $deleteForm = $this->createDeleteForm($perinatal);

        return $this->render('perinatal/show.html.twig', array(
                    'perinatal' => $perinatal,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing perinatal entity.
     *
     * @Route("/{id}/edit", name="perinatal_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Perinatal $perinatal) {
        $deleteForm = $this->createDeleteForm($perinatal);
        $editForm = $this->createForm('AppBundle\Form\PerinatalType', $perinatal);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $perinatal->setFechaActualizacion(new \DateTime("now"));
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Datos actualizados satisfactoriamente');

             return $this->redirectToRoute('homepage_consulta', array(
                        'paciente' => $perinatal->getPaciente()->getId(),
            )); 
           
        }

        return $this->render('perinatal/edit.html.twig', array(
                    'perinatal' => $perinatal,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a perinatal entity.
     *
     * @Route("/{id}", name="perinatal_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Perinatal $perinatal) {
        $form = $this->createDeleteForm($perinatal);
        $form->handleRequest($request);
        $paciente = $perinatal->getPaciente()->getId();  

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $id = $perinatal->getPaciente()->getId();
            $em->remove($perinatal);
            $em->flush($perinatal);
        }

       return $this->redirectToRoute('homepage_consulta', array(
                    'paciente' => $id,
        ));
    }

    /**
     * Creates a form to delete a perinatal entity.
     *
     * @param Perinatal $perinatal The perinatal entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Perinatal $perinatal) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('perinatal_delete', array('id' => $perinatal->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}

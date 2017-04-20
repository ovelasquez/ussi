<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Sicobiologico;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Sicobiologico controller.
 *
 * @Route("sicobiologico")
 */
class SicobiologicoController extends Controller {

    /**
     * Lists all sicobiologico entities.
     *
     * @Route("/", name="sicobiologico_index")
     * @Method("GET")
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $sicobiologicos = $em->getRepository('AppBundle:Sicobiologico')->findAll();

        return $this->render('sicobiologico/index.html.twig', array(
                    'sicobiologicos' => $sicobiologicos,
        ));
    }

    /**
     * Creates a new sicobiologico entity.
     *
     * @Route("/new", name="sicobiologico_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request) {
        $sicobiologico = new Sicobiologico();
        $form = $this->createForm('AppBundle\Form\SicobiologicoType', $sicobiologico);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $paciente = $em->getRepository('AppBundle:Paciente')->find($request->request->get('i_paciente'));

            $sicobiologico->setPaciente($paciente);
            $sicobiologico->setFechaRegistro(new \DateTime("now"));
            $em->persist($sicobiologico);
            $em->flush($sicobiologico);
              return $this->redirectToRoute('homepage_consulta', array(
                        'paciente' => $sicobiologico->getPaciente()->getId(),
            ));
            
        }

        return $this->render('sicobiologico/new.html.twig', array(
                    'sicobiologico' => $sicobiologico,
                    'form' => $form->createView(),
                    'i_paciente' => $request->request->get('i_paciente'))
        );
    }

    /**
     * Finds and displays a sicobiologico entity.
     *
     * @Route("/{id}", name="sicobiologico_show")
     * @Method("GET")
     */
    public function showAction(Sicobiologico $sicobiologico) {
        $deleteForm = $this->createDeleteForm($sicobiologico);

        return $this->render('sicobiologico/show.html.twig', array(
                    'sicobiologico' => $sicobiologico,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing sicobiologico entity.
     *
     * @Route("/{id}/edit", name="sicobiologico_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Sicobiologico $sicobiologico) {
        $deleteForm = $this->createDeleteForm($sicobiologico);
        $editForm = $this->createForm('AppBundle\Form\SicobiologicoType', $sicobiologico);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $sicobiologico->setFechaActualizacion(new \DateTime("now"));
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Datos actualizados satisfactoriamente');
            
            return $this->redirectToRoute('homepage_consulta', array(
                        'paciente' => $sicobiologico->getPaciente()->getId(),
            ));

            
        }

        return $this->render('sicobiologico/edit.html.twig', array(
                    'sicobiologico' => $sicobiologico,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a sicobiologico entity.
     *
     * @Route("/{id}", name="sicobiologico_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Sicobiologico $sicobiologico) {
        $form = $this->createDeleteForm($sicobiologico);
        $form->handleRequest($request);
        $paciente = $sicobiologico->getPaciente()->getId();


        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($sicobiologico);
            $em->flush($sicobiologico);
        }

        return $this->redirectToRoute('paciente_show', array('id' => $paciente));
    }

    /**
     * Creates a form to delete a sicobiologico entity.
     *
     * @param Sicobiologico $sicobiologico The sicobiologico entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Sicobiologico $sicobiologico) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('sicobiologico_delete', array('id' => $sicobiologico->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}

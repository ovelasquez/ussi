<?php

namespace AppBundle\Controller;

use AppBundle\Entity\MedicamentoSuministrado;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Medicamentosuministrado controller.
 *
 * @Route("medicamentosuministrado")
 */
class MedicamentoSuministradoController extends Controller {

    /**
     * Lists all medicamentoSuministrado entities.
     *
     * @Route("/", name="medicamentosuministrado_index")
     * @Method("GET")
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $medicamentoSuministrados = $em->getRepository('AppBundle:MedicamentoSuministrado')->findAll();

        return $this->render('medicamentosuministrado/index.html.twig', array(
                    'medicamentoSuministrados' => $medicamentoSuministrados,
        ));
    }

    /**
     * Creates a new medicamentoSuministrado entity.
     *
     * @Route("/new", name="medicamentosuministrado_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $consulta = NULL;

        //  dump($request); die();

        if ($request->request->get('medicamentosuministrado_consulta')) {
            $consulta = $em->getRepository('AppBundle:Consulta')->find($request->request->get('medicamentosuministrado_consulta'));
        }

        $medicamentoSuministrado = new Medicamentosuministrado();
        if ($consulta) {
            $medicamentoSuministrado->setConsulta($consulta);
            $medicamentoSuministrado->setUsuario($this->getUser());
            $medicamentoSuministrado->setFecha(new \DateTime("now"));
        }

        $form = $this->createForm('AppBundle\Form\MedicamentoSuministradoType', $medicamentoSuministrado);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($medicamentoSuministrado);
            $em->flush($medicamentoSuministrado);

            $this->addFlash('success', 'Medicamento Suministrado registrado satisfactoriamente');
            return $this->redirectToRoute('homepage_enfermeria', array('paciente' => $medicamentoSuministrado->getConsulta()->getPaciente()->getId(),));
        }

        return $this->render('medicamentosuministrado/new.html.twig', array(
                    'medicamentoSuministrado' => $medicamentoSuministrado,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a medicamentoSuministrado entity.
     *
     * @Route("/{id}", name="medicamentosuministrado_show")
     * @Method("GET")
     */
    public function showAction(MedicamentoSuministrado $medicamentoSuministrado) {
        $deleteForm = $this->createDeleteForm($medicamentoSuministrado);

        return $this->render('medicamentosuministrado/show.html.twig', array(
                    'medicamentoSuministrado' => $medicamentoSuministrado,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing medicamentoSuministrado entity.
     *
     * @Route("/{id}/edit", name="medicamentosuministrado_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, MedicamentoSuministrado $medicamentoSuministrado) {
        $deleteForm = $this->createDeleteForm($medicamentoSuministrado);
        $editForm = $this->createForm('AppBundle\Form\MedicamentoSuministradoType', $medicamentoSuministrado);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('medicamentosuministrado_edit', array('id' => $medicamentoSuministrado->getId()));
        }

        return $this->render('medicamentosuministrado/edit.html.twig', array(
                    'medicamentoSuministrado' => $medicamentoSuministrado,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a medicamentoSuministrado entity.
     *
     * @Route("/{id}", name="medicamentosuministrado_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, MedicamentoSuministrado $medicamentoSuministrado) {
        $form = $this->createDeleteForm($medicamentoSuministrado);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($medicamentoSuministrado);
            $em->flush($medicamentoSuministrado);
        }

        return $this->redirectToRoute('medicamentosuministrado_index');
    }

    /**
     * Creates a form to delete a medicamentoSuministrado entity.
     *
     * @param MedicamentoSuministrado $medicamentoSuministrado The medicamentoSuministrado entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(MedicamentoSuministrado $medicamentoSuministrado) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('medicamentosuministrado_delete', array('id' => $medicamentoSuministrado->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}

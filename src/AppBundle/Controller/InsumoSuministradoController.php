<?php

namespace AppBundle\Controller;

use AppBundle\Entity\InsumoSuministrado;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Insumosuministrado controller.
 *
 * @Route("insumosuministrado")
 */
class InsumoSuministradoController extends Controller {

    /**
     * Lists all insumoSuministrado entities.
     *
     * @Route("/", name="insumosuministrado_index")
     * @Method("GET")
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $insumoSuministrados = $em->getRepository('AppBundle:InsumoSuministrado')->findAll();

        return $this->render('insumosuministrado/index.html.twig', array(
                    'insumoSuministrados' => $insumoSuministrados,
        ));
    }

    /**
     * Creates a new insumoSuministrado entity.
     *
     * @Route("/new", name="insumosuministrado_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $consulta = NULL;

        if ($request->request->get('insumosuministrado_consulta')) {
            $consulta = $em->getRepository('AppBundle:Consulta')->find($request->request->get('insumosuministrado_consulta'));
        }
        $insumoSuministrado = new InsumoSuministrado();

        if ($consulta) {
            $insumoSuministrado->setConsulta($consulta);
            $insumoSuministrado->setUsuario($this->getUser());
            $insumoSuministrado->setFecha(new \DateTime("now"));
        }



        $form = $this->createForm('AppBundle\Form\InsumoSuministradoType', $insumoSuministrado);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($insumoSuministrado);
            $em->flush($insumoSuministrado);
            $this->addFlash('success', 'Insumo Suministrado registrado satisfactoriamente');

            return $this->redirectToRoute('homepage_enfermeria', array(
                        'paciente' => $insumoSuministrado->getConsulta()->getPaciente()->getId(),
            ));
        }

        return $this->render('insumosuministrado/new.html.twig', array(
                    'insumoSuministrado' => $insumoSuministrado,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a insumoSuministrado entity.
     *
     * @Route("/{id}", name="insumosuministrado_show")
     * @Method("GET")
     */
    public function showAction(InsumoSuministrado $insumoSuministrado) {
        $deleteForm = $this->createDeleteForm($insumoSuministrado);

        return $this->render('insumosuministrado/show.html.twig', array(
                    'insumoSuministrado' => $insumoSuministrado,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing insumoSuministrado entity.
     *
     * @Route("/{id}/edit", name="insumosuministrado_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, InsumoSuministrado $insumoSuministrado) {
        $deleteForm = $this->createDeleteForm($insumoSuministrado);
        $editForm = $this->createForm('AppBundle\Form\InsumoSuministradoType', $insumoSuministrado);
        $editForm->handleRequest($request);
        
        dump($insumoSuministrado); die();

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Insumo Suministrado modificado satisfactoriamente');
             return $this->redirectToRoute('homepage_enfermeria', array('paciente' => $insumoSuministrado->getConsulta()->getPaciente()->getId(), ));
        }

        return $this->render('insumosuministrado/edit.html.twig', array(
                    'insumoSuministrado' => $insumoSuministrado,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a insumoSuministrado entity.
     *
     * @Route("/{id}", name="insumosuministrado_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, InsumoSuministrado $insumoSuministrado) {
        $form = $this->createDeleteForm($insumoSuministrado);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($insumoSuministrado);
            $em->flush($insumoSuministrado);
        }

        return $this->redirectToRoute('insumosuministrado_index');
    }

    /**
     * Creates a form to delete a insumoSuministrado entity.
     *
     * @param InsumoSuministrado $insumoSuministrado The insumoSuministrado entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(InsumoSuministrado $insumoSuministrado) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('insumosuministrado_delete', array('id' => $insumoSuministrado->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}

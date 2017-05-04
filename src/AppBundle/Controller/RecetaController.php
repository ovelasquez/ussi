<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Receta;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Recetum controller.
 *
 * @Route("receta")
 */
class RecetaController extends Controller {

    /**
     * Lists all recetum entities.
     *
     * @Route("/", name="receta_index")
     * @Method("GET")
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $recetas = $em->getRepository('AppBundle:Receta')->findAll();

        return $this->render('receta/index.html.twig', array(
                    'recetas' => $recetas,
        ));
    }

    /**
     * Creates a new recetum entity.
     *
     * @Route("/new", name="receta_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $consulta = NULL;

        if ($request->request->get('receta_consulta')) {
            $consulta = $em->getRepository('AppBundle:Consulta')->find($request->request->get('receta_consulta'));
        }
        $recetum = new Receta();

        if ($consulta) {
            $recetum->setConsulta($consulta);
        }


        $form = $this->createForm('AppBundle\Form\RecetaType', $recetum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($recetum);
            $em->flush($recetum);
            $this->addFlash('success', 'Receta registrada satisfactoriamente');

            switch ($recetum->getConsulta()->getEspecialidad()->getNombre()) {
                case('Odontología'): return $this->redirectToRoute('homepage_odontologia', array('paciente' => $recetum->getConsulta()->getPaciente()->getId(),));
                    break;
                case('Enfermería'): return $this->redirectToRoute('homepage_enfermeria', array('paciente' => $recetum->getConsulta()->getPaciente()->getId(),));
                    break;
                default : return $this->redirectToRoute('homepage_consulta', array('paciente' => $recetum->getConsulta()->getPaciente()->getId(),));
                    break;
            }
        }

        return $this->render('receta/new.html.twig', array(
                    'recetum' => $recetum,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a recetum entity.
     *
     * @Route("/{id}", name="receta_show")
     * @Method("GET")
     */
    public function showAction(Receta $recetum) {
        $deleteForm = $this->createDeleteForm($recetum);

        return $this->render('receta/show.html.twig', array(
                    'recetum' => $recetum,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing recetum entity.
     *
     * @Route("/{id}/edit", name="receta_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Receta $recetum) {
        $deleteForm = $this->createDeleteForm($recetum);
        $editForm = $this->createForm('AppBundle\Form\RecetaType', $recetum);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Receta actualizada satisfactoriamente');

            switch ($recetum->getConsulta()->getEspecialidad()->getNombre()) {
                case('Odontología'): return $this->redirectToRoute('homepage_odontologia', array('paciente' => $recetum->getConsulta()->getPaciente()->getId(),));
                    break;
                case('Enfermería'): return $this->redirectToRoute('homepage_enfermeria', array('paciente' => $recetum->getConsulta()->getPaciente()->getId(),));
                    break;
                default : return $this->redirectToRoute('homepage_consulta', array('paciente' => $recetum->getConsulta()->getPaciente()->getId(),));
                    break;
            }
        }

        return $this->render('receta/edit.html.twig', array(
                    'recetum' => $recetum,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a recetum entity.
     *
     * @Route("/{id}", name="receta_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Receta $recetum) {
        $form = $this->createDeleteForm($recetum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $id = $recetum->getConsulta()->getPaciente()->getId();
            $em->remove($recetum);
            $em->flush($recetum);
        }
        $this->addFlash('success', 'Receta eliminada satisfactoriamente');

        switch ($recetum->getConsulta()->getEspecialidad()->getNombre()) {
            case('Odontología'): return $this->redirectToRoute('homepage_odontologia', array('paciente' => $recetum->getConsulta()->getPaciente()->getId(),));
                break;
            case('Enfermería'): return $this->redirectToRoute('homepage_enfermeria', array('paciente' => $recetum->getConsulta()->getPaciente()->getId(),));
                break;
            default : return $this->redirectToRoute('homepage_consulta', array('paciente' => $recetum->getConsulta()->getPaciente()->getId(),));
                break;
        }
    }

    /**
     * Creates a form to delete a recetum entity.
     *
     * @param Receta $recetum The recetum entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Receta $recetum) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('receta_delete', array('id' => $recetum->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}

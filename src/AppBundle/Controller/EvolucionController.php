<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Evolucion;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Evolucion controller.
 *
 * @Route("evolucion")
 */
class EvolucionController extends Controller {

    /**
     * Lists all evolucion entities.
     *
     * @Route("/", name="evolucion_index")
     * @Method("GET")
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $evolucions = $em->getRepository('AppBundle:Evolucion')->findAll();

        return $this->render('evolucion/index.html.twig', array(
                    'evolucions' => $evolucions,
        ));
    }

    /**
     * Creates a new evolucion entity.
     *
     * @Route("/new", name="evolucion_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request) {
        $em = $this->getDoctrine()->getManager();                 
        $consulta = $em->getRepository('AppBundle:Consulta')->find($request->query->get('consulta'));
       
        //Verificamos si no tiene una Evolucion asociada a laconsulta
        $tieneEvolucion = $em->getRepository('AppBundle:Evolucion')->findOneByConsulta($consulta);
        //dump($tieneEvolucion);die();
        if ($tieneEvolucion) {
            return $this->redirectToRoute('evolucion_show', array('id' => $tieneEvolucion->getId()));
        } else {

            //Crear Evoucion
            $evolucion = new Evolucion();
            $form = $this->createForm('AppBundle\Form\EvolucionType', $evolucion);
            $form->handleRequest($request);


            if ($form->isSubmitted() && $form->isValid()) {

                $evolucion->setConsulta($consulta);

                $em = $this->getDoctrine()->getManager();
                $em->persist($evolucion);
                $em->flush($evolucion);

                return $this->redirectToRoute('homepage_consulta', array('paciente' => $consulta->getPaciente()->getId()));
            }


            return $this->render('evolucion/new.html.twig', array(
                        'evolucion' => $evolucion,
                        'form' => $form->createView(),
                        'consulta' => $consulta,
            ));
        }
    }

    /**
     * Finds and displays a evolucion entity.
     *
     * @Route("/{id}", name="evolucion_show")
     * @Method("GET")
     */
    public function showAction(Evolucion $evolucion) {
        $deleteForm = $this->createDeleteForm($evolucion);

        return $this->render('evolucion/show.html.twig', array(
                    'evolucion' => $evolucion,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing evolucion entity.
     *
     * @Route("/{id}/edit", name="evolucion_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Evolucion $evolucion) {
        $deleteForm = $this->createDeleteForm($evolucion);
        $editForm = $this->createForm('AppBundle\Form\EvolucionType', $evolucion);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('homepage_consulta', array('paciente' => $evolucion->getConsulta()->getPaciente()->getId()));
        }

        return $this->render('evolucion/edit.html.twig', array(
                    'evolucion' => $evolucion,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a evolucion entity.
     *
     * @Route("/{id}", name="evolucion_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Evolucion $evolucion) {
        $form = $this->createDeleteForm($evolucion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($evolucion);
            $em->flush($evolucion);
        }

        return $this->redirectToRoute('evolucion_index');
    }

    /**
     * Creates a form to delete a evolucion entity.
     *
     * @param Evolucion $evolucion The evolucion entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Evolucion $evolucion) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('evolucion_delete', array('id' => $evolucion->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}

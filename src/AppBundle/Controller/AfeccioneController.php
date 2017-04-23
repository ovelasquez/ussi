<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Afeccione;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Afeccione controller.
 *
 * @Route("afeccione")
 */
class AfeccioneController extends Controller {

    /**
     * Lists all afeccione entities.
     *
     * @Route("/", name="afeccione_index")
     * @Method("GET")
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $afecciones = $em->getRepository('AppBundle:Afeccione')->findAll();

        return $this->render('afeccione/index.html.twig', array(
                    'afecciones' => $afecciones,
        ));
    }

    /**
     * Creates a new afeccione entity.
     *
     * @Route("/new", name="afeccione_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $consulta = NULL;

        if ($request->request->get('afecciones_consulta')) {
            $consulta = $em->getRepository('AppBundle:Consulta')->find($request->request->get('afecciones_consulta'));
        }

        //Crear Afeccione
        $afeccione = new Afeccione();

        if ($consulta) {
            $afeccione->setConsulta($consulta);
        }

        $form = $this->createForm('AppBundle\Form\AfeccioneType', $afeccione);
        $form->handleRequest($request);

        if (!($afeccione->getDiagnostico() == null || $afeccione->getTratamiento() == null || $afeccione->getConsulta() == null || $afeccione->getEntericaElemento() == null)) {

            if ($form->isSubmitted() && $form->isValid()) {

                $em = $this->getDoctrine()->getManager();
                $em->persist($afeccione);
                $em->flush($afeccione);

                return $this->redirectToRoute('homepage_consulta', array(
                            'paciente' => $afeccione->getConsulta()->getPaciente()->getId(),
                ));
            }
        }





        return $this->render('afeccione/new.html.twig', array(
                    'afeccione' => $afeccione,
                    'form' => $form->createView(),
                    'consulta' => $consulta,
        ));
    }

    /**
     * Finds and displays a afeccione entity.
     *
     * @Route("/{id}", name="afeccione_show")
     * @Method("GET")
     */
    public function showAction(Afeccione $afeccione) {
        $deleteForm = $this->createDeleteForm($afeccione);

        return $this->render('afeccione/show.html.twig', array(
                    'afeccione' => $afeccione,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing afeccione entity.
     *
     * @Route("/{id}/edit", name="afeccione_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Afeccione $afeccione) {
        $deleteForm = $this->createDeleteForm($afeccione);
        $editForm = $this->createForm('AppBundle\Form\AfeccioneType', $afeccione);
        $editForm->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        

        if (!($afeccione->getDiagnostico() == null || $afeccione->getTratamiento() == null || $afeccione->getConsulta() == null || $afeccione->getEntericaElemento() == null)) {

            if ($editForm->isSubmitted() && $editForm->isValid()) {
                $this->getDoctrine()->getManager()->flush();
                
                return $this->redirectToRoute('homepage_consulta', array(
                            'paciente' => $afeccione->getConsulta()->getPaciente()->getId()));
            }
        }
        
        return $this->render('afeccione/edit.html.twig', array(
                    'afeccione' => $afeccione,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a afeccione entity.
     *
     * @Route("/{id}", name="afeccione_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Afeccione $afeccione) {
        $form = $this->createDeleteForm($afeccione);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $id = $afeccione->getConsulta()->getPaciente()->getId();
            $em->remove($afeccione);
            $em->flush($afeccione);
        }

        return $this->redirectToRoute('homepage_consulta', array(
                    'paciente' => $id,
        ));
    }

    /**
     * Creates a form to delete a afeccione entity.
     *
     * @param Afeccione $afeccione The afeccione entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Afeccione $afeccione) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('afeccione_delete', array('id' => $afeccione->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}

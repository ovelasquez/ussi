<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Odontograma;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Odontograma controller.
 *
 * @Route("odontograma")
 */
class OdontogramaController extends Controller {

    /**
     * Lists all odontograma entities.
     *
     * @Route("/", name="odontograma_index")
     * @Method("GET")
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $odontogramas = $em->getRepository('AppBundle:Odontograma')->findAll();

        return $this->render('odontograma/index.html.twig', array(
                    'odontogramas' => $odontogramas,
        ));
    }

    /**
     * Creates a new odontograma entity.
     *
     * @Route("/new", name="odontograma_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request) {
       // dump($request); die();
        $em = $this->getDoctrine()->getManager();
        $consulta = NULL;

        if ($request->request->get('odontograma_consulta')) {
            $consulta = $em->getRepository('AppBundle:Consulta')->find($request->request->get('odontograma_consulta'));
        }
        $odontograma = new Odontograma();
        
        if ($consulta) {
            $odontograma->setConsulta($consulta);            
        }


        $form = $this->createForm('AppBundle\Form\OdontogramaType', $odontograma);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
           
            $em->persist($odontograma);
            $em->flush($odontograma);

            $this->addFlash('success', 'Odontograma registrado satisfactoriamente');
            return $this->redirectToRoute('homepage_odontologia', array(
                        'paciente' => $odontograma->getConsulta()->getPaciente()->getId(),
            ));
        }

        return $this->render('odontograma/new.html.twig', array(
                    'odontograma' => $odontograma,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a odontograma entity.
     *
     * @Route("/{id}", name="odontograma_show")
     * @Method("GET")
     */
    public function showAction(Odontograma $odontograma) {
        $deleteForm = $this->createDeleteForm($odontograma);

        return $this->render('odontograma/show.html.twig', array(
                    'odontograma' => $odontograma,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing odontograma entity.
     *
     * @Route("/{id}/edit", name="odontograma_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Odontograma $odontograma) {
        $deleteForm = $this->createDeleteForm($odontograma);
        $editForm = $this->createForm('AppBundle\Form\OdontogramaType', $odontograma);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('odontograma_edit', array('id' => $odontograma->getId()));
        }

        return $this->render('odontograma/edit.html.twig', array(
                    'odontograma' => $odontograma,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a odontograma entity.
     *
     * @Route("/{id}", name="odontograma_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Odontograma $odontograma) {
        $form = $this->createDeleteForm($odontograma);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($odontograma);
            $em->flush($odontograma);
        }

        return $this->redirectToRoute('odontograma_index');
    }

    /**
     * Creates a form to delete a odontograma entity.
     *
     * @param Odontograma $odontograma The odontograma entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Odontograma $odontograma) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('odontograma_delete', array('id' => $odontograma->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}

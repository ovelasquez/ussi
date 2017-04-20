<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Patologia;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Patologium controller.
 *
 * @Route("patologia")
 */
class PatologiaController extends Controller
{
    /**
     * Lists all patologium entities.
     *
     * @Route("/", name="patologia_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $patologias = $em->getRepository('AppBundle:Patologia')->findAll();

        return $this->render('patologia/index.html.twig', array(
            'patologias' => $patologias,
        ));
    }

    /**
     * Creates a new patologium entity.
     *
     * @Route("/new", name="patologia_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $patologium = new Patologia();
        $form = $this->createForm('AppBundle\Form\PatologiaType', $patologium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $paciente = $em->getRepository('AppBundle:Paciente')->find($request->request->get('ii_paciente'));
            
            $patologium->setPaciente($paciente);
            $patologium->setFechaRegistro(new \DateTime("now"));
            $em->persist($patologium);
            $em->flush($patologium);
            
            return $this->redirectToRoute('homepage_consulta', array(
                        'paciente' => $patologium->getPaciente()->getId(),
            ));            
        }

        return $this->render('patologia/new.html.twig', array(
            'patologium' => $patologium,
            'form' => $form->createView(),
            'ii_paciente' => $request->get('ii_paciente')
        ));
    }

    /**
     * Finds and displays a patologium entity.
     *
     * @Route("/{id}", name="patologia_show")
     * @Method("GET")
     */
    public function showAction(Patologia $patologium)
    {
        $deleteForm = $this->createDeleteForm($patologium);

        return $this->render('patologia/show.html.twig', array(
            'patologium' => $patologium,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing patologium entity.
     *
     * @Route("/{id}/edit", name="patologia_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Patologia $patologium)
    {
        $deleteForm = $this->createDeleteForm($patologium);
        $editForm = $this->createForm('AppBundle\Form\PatologiaType', $patologium);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $patologium->setFechaActualizacion(new \DateTime("now"));
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Datos actualizados satisfactoriamente');
            
             return $this->redirectToRoute('homepage_consulta', array(
                        'paciente' => $patologium->getPaciente()->getId(),
            )); 

            
        }

        return $this->render('patologia/edit.html.twig', array(
            'patologium' => $patologium,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a patologium entity.
     *
     * @Route("/{id}", name="patologia_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Patologia $patologium)
    {
        $form = $this->createDeleteForm($patologium);
        $form->handleRequest($request);
        $paciente=$patologium->getPaciente()->getId();

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($patologium);
            $em->flush($patologium);
        }

        return $this->redirectToRoute('paciente_show' , array('id' => $paciente));
    }

    /**
     * Creates a form to delete a patologium entity.
     *
     * @param Patologia $patologium The patologium entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Patologia $patologium)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('patologia_delete', array('id' => $patologium->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

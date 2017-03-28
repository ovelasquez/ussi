<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Persona;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Persona controller.
 *
 * @Route("persona")
 */
class PersonaController extends Controller {

    /**
     * Lists all persona entities.
     *
     * @Route("/", name="persona_index")
     * @Method("GET")
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $personas = $em->getRepository('AppBundle:Persona')->findAll();

        return $this->render('persona/index.html.twig', array(
                    'personas' => $personas,
        ));
    }

    /**
     * Creates a new persona entity.
     *
     * @Route("/new", name="persona_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request) {
        $persona = new Persona();
        $form = $this->createForm('AppBundle\Form\PersonaType', $persona);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($persona->getFoto() === null) {
                $persona->setFoto('user.png');
            }
            $em = $this->getDoctrine()->getManager();
            $persona->setFechaRegistro(new \DateTime("now"));
            $em->persist($persona);
            $em->flush($persona);

            return $this->redirectToRoute('persona_show', array('id' => $persona->getId()));
        }

        return $this->render('persona/new.html.twig', array(
                    'persona' => $persona,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a persona entity.
     *
     * @Route("/{id}", name="persona_show")
     * @Method("GET")
     */
    public function showAction(Persona $persona) {
        $deleteForm = $this->createDeleteForm($persona);

        return $this->render('persona/show.html.twig', array(
                    'persona' => $persona,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing persona entity.
     *
     * @Route("/{id}/edit", name="persona_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Persona $persona) {
        $fileOld = $persona->getFoto();

        $deleteForm = $this->createDeleteForm($persona);
        $editForm = $this->createForm('AppBundle\Form\PersonaType', $persona);
        $editForm->handleRequest($request);

        if ($persona->getFoto() === null && $fileOld !== null) {
            $persona->setFoto($fileOld);
        }

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $persona->setFechaActualizacion(new \DateTime("now"));
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Datos actualizados satisfactoriamente');

            return $this->redirectToRoute('persona_show', array('id' => $persona->getId()));
        }

        return $this->render('persona/edit.html.twig', array(
                    'persona' => $persona,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a persona entity.
     *
     * @Route("/{id}", name="persona_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Persona $persona) {
        $form = $this->createDeleteForm($persona);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($persona);
            $em->flush($persona);
            $this->addFlash('success', 'Registro eliminado satisfactoriamente');
        }

        return $this->redirectToRoute('persona_index');
    }

    /**
     * Creates a form to delete a persona entity.
     *
     * @param Persona $persona The persona entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Persona $persona) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('persona_delete', array('id' => $persona->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

    public function crearPersona($persona) {
        $em = $this->getDoctrine()->getManager();
        $miPersona = new Persona();
        $miPersona->setNacionalidad($persona['nacionalidad']);
        $miPersona->setCedula($persona['cedula']);
        $miPersona->setPrimerApellido($persona['primerApellido']);
        $miPersona->setSegundoApellido($persona['segundoApellido']);
        $miPersona->setPrimerNombre($persona['primerNombre']);
        $miPersona->setSegundoNombre($persona['segundoNombre']);
        $miPersona->setGenero($persona['genero']);
        $miPersona->setTelefono($persona['telefono']);
        $miPersona->setEmail($persona['email']);
        if (!empty($persona['foto'])) {
            $miPersona->setFoto($persona['foto']);
        } else {
            $miPersona->setFoto('user.png');
        }
        $miPersona->setFechaRegistro(new \DateTime("now"));
        $em->flush($miPersona);
        return $miPersona;
    }

}

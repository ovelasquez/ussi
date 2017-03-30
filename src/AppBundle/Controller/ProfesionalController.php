<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Profesional;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Paciente;
use Symfony\Component\Validator\Constraints\Date;

/**
 * Profesional controller.
 *
 * @Route("profesional")
 */
class ProfesionalController extends Controller {

    /**
     * Lists all profesional entities.
     *
     * @Route("/", name="profesional_index")
     * @Method("GET")
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $profesionals = $em->getRepository('AppBundle:Profesional')->findAll();

        return $this->render('profesional/index.html.twig', array(
                    'profesionals' => $profesionals,
        ));
    }

    /**
     * Creates a new profesional entity.
     *
     * @Route("/new", name="profesional_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request) {
        //  dump($request); die();
        $profesional = new Profesional();
        $form = $this->createForm('AppBundle\Form\ProfesionalType', $profesional);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($profesional);
            $em->flush($profesional);

            $valor = $request->request->get('appbundle_profesional');
            $fechaNacimiento = ($valor['fechaNacimiento']);
            $miPaciente = new Paciente();
            $miPaciente->setEdoCivil($valor['edoCivil']);
            $miPaciente->setOcupacion($valor['ocupacion']);
            $miPaciente->setEstudio($valor['estudio']);
            $miPaciente->setAnoAprobado($valor['anoAprobado']);
            $miPaciente->setAnalfabeta(FALSE);
            $miPaciente->setFechaNacimiento(new \DateTime($fechaNacimiento['year'] . "-" . $fechaNacimiento['month'] . "-" . $fechaNacimiento['day']));
            $miPaciente->setFechaRegistro(new \DateTime("now"));
            $miPaciente->setApellidoFamilia($valor['apellidoFamilia']);
            $miPaciente->setCedulaJefeFamilia($valor['cedulaJefeFamilia']);
            $miPaciente->setComunidad($valor['comunidad']);

            $etnia = $em->getRepository('AppBundle:Etnia')->find($valor['etnia']);
            $miPaciente->setEtnia($etnia);

            $religion = $em->getRepository('AppBundle:Religion')->find($valor['religion']);
            $miPaciente->setReligion($religion);


            $miPaciente->setPersona($profesional->getPersona());

            //dump($miPaciente); die();

            $em->persist($miPaciente);
            $em->flush($miPaciente);

            return $this->redirectToRoute('profesional_show', array('id' => $profesional->getId()));
        }

        return $this->render('profesional/new.html.twig', array(
                    'profesional' => $profesional,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a profesional entity.
     *
     * @Route("/{id}", name="profesional_show")
     * @Method("GET")
     */
    public function showAction(Profesional $profesional) {
        $deleteForm = $this->createDeleteForm($profesional);

        return $this->render('profesional/show.html.twig', array(
                    'profesional' => $profesional,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing profesional entity.
     *
     * @Route("/{id}/edit", name="profesional_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Profesional $profesional) {
        $deleteForm = $this->createDeleteForm($profesional);
        $editForm = $this->createForm('AppBundle\Form\ProfesionalType', $profesional);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('profesional_edit', array('id' => $profesional->getId()));
        }

        return $this->render('profesional/edit.html.twig', array(
                    'profesional' => $profesional,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a profesional entity.
     *
     * @Route("/{id}", name="profesional_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Profesional $profesional) {
        $form = $this->createDeleteForm($profesional);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($profesional);
            $em->flush($profesional);
        }

        return $this->redirectToRoute('profesional_index');
    }

    /**
     * Creates a form to delete a profesional entity.
     *
     * @param Profesional $profesional The profesional entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Profesional $profesional) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('profesional_delete', array('id' => $profesional->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}

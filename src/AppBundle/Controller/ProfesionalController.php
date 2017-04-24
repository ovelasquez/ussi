<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Profesional;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Paciente;

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

        $profesional = new Profesional();
        $form = $this->createForm('AppBundle\Form\ProfesionalType', $profesional);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /*   $valores=($request->request->get('appbundle_profesional')); 
              dump($valores['persona']['foto']);
              die(); */

            $valor = $request->request->get('appbundle_profesional');

            $em = $this->getDoctrine()->getManager();
            $em->persist($profesional);
            if ($profesional->getPersona()->getFoto() == null) {
                $profesional->getPersona()->setFoto('user.png');
            }
            $profesional->getPersona()->setFechaRegistro(new \DateTime("now"));
            $em->flush($profesional);


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

             if (!empty($valor['etnia'])) {
                $etnia = $em->getRepository('AppBundle:Etnia')->find($valor['etnia']);
                $miPaciente->setEtnia($etnia);
            }else{
                $miPaciente->setEtnia(null);
            }
            if (!empty($valor['religion'])) {
                $religion = $em->getRepository('AppBundle:Religion')->find($valor['religion']);               
                $miPaciente->setReligion($religion);
            }else{
                $miPaciente->setReligion(null);
            }


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
        
        $em = $this->getDoctrine()->getManager();
        $paciente = $em->getRepository('AppBundle:Paciente')->findOneByPersona($profesional->getPersona());
        
        return $this->render('profesional/show.html.twig', array(
                    'profesional' => $profesional,
                    'paciente' => $paciente,
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

        if ($profesional !== null) {
            $foto = $profesional->getPersona()->getFoto();
        }

        $deleteForm = $this->createDeleteForm($profesional);
        $editForm = $this->createForm('AppBundle\Form\ProfesionalType', $profesional);
        $editForm->handleRequest($request);

        $em = $this->getDoctrine()->getManager();
        $paciente = $em->getRepository('AppBundle:Paciente')->findOneByPersona($profesional->getPersona());
        //dump($paciente);       die();
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            //Add Profesional / Persona
            if ($profesional->getPersona()->getFoto() === null) {
                $profesional->getPersona()->setFoto($foto);
            }
            $this->getDoctrine()->getManager()->flush();

            //Add Paciente
            $valor = $request->request->get('appbundle_profesional');
            //dump($valor); die();
            $fechaNacimiento = ($valor['fechaNacimiento']);
            
            //$paciente = new Paciente();
            $paciente->setEdoCivil($valor['edoCivil']);
            $paciente->setOcupacion($valor['ocupacion']);
            $paciente->setEstudio($valor['estudio']);
            $paciente->setAnoAprobado($valor['anoAprobado']);
            $paciente->setAnalfabeta(FALSE);
            $paciente->setFechaNacimiento(new \DateTime($fechaNacimiento['year'] . "-" . $fechaNacimiento['month'] . "-" . $fechaNacimiento['day']));
            $paciente->setFechaActualizacion(new \DateTime("now"));
            $paciente->setApellidoFamilia($valor['apellidoFamilia']);
            $paciente->setCedulaJefeFamilia($valor['cedulaJefeFamilia']);
            $paciente->setComunidad($valor['comunidad']);
            $paciente->setPersona($profesional->getPersona());
            if (!empty($valor['etnia'])) {
                $etnia = $em->getRepository('AppBundle:Etnia')->find($valor['etnia']);
                $paciente->setEtnia($etnia);
            }else{
                $paciente->setEtnia(null);
            }
            if (!empty($valor['religion'])) {
                $religion = $em->getRepository('AppBundle:Religion')->find($valor['religion']);               
                $paciente->setReligion($religion);
            }else{
                $paciente->setReligion(null);
            }
            $em->persist($paciente);
           // dump($paciente); die();
            $em->flush($paciente);
            $this->addFlash('success', 'Datos actualizados satisfactoriamente');
            return $this->redirectToRoute('profesional_show', array('id' => $profesional->getId()));
        }

         // dump($paciente);  die();
        
        return $this->render('profesional/edit.html.twig', array(
                    'profesional' => $profesional,
                    'paciente' => $paciente,
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

<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Ajax controller.
 *
 * @Route("ajax")
 */
class AjaxController extends Controller {

    /**
     * 
     *
     * @Route("/estanLlamando", name="ajax_estanLlamando")
     * @Method({"GET", "POST"})
     */
    public function estanLlamandoAction() {
        $em = $this->getDoctrine()->getManager();
        $lista = $em->getRepository('AppBundle:Esperando')->findByStatus('procesando');
        // encode user to json format
        $userDataAsJson = $this->encodeUserDataToJson($lista);
        //dump($userDataAsJson);   die(); 
        return new JsonResponse([
            'success' => true,
            'data' => [$userDataAsJson]
        ]);
    }

    private function encodeUserDataToJson(Array $valor) {
        $procesando = array();
        foreach ($valor as &$lista) {

            $userData = array(
                'id' => $lista->getId(),
                'paciente' => array(
                    'id' => $lista->getPaciente()->getId(),
                    'cedula' => $lista->getPaciente()->getPersona()->getNacionalidad() . ' - ' . $lista->getPaciente()->getPersona()->getCedula(),
                    'nombre' => $lista->getPaciente()->getPersona()->getPrimerNombre() . ' ' . $lista->getPaciente()->getPersona()->getPrimerApellido(),
                    'foto' => $lista->getPaciente()->getPersona()->getFoto()->getFilename(),
                ),
                'especialidad' => array(
                    'nombre' => $lista->getEspecialidad()->getNombre(),
                ),
                'medico' => array(
                    'id' => $lista->getMedico()->getId(),
                    'nombre' => $lista->getMedico()->getPersona()->getPrimerNombre() . ' ' . $lista->getMedico()->getPersona()->getPrimerApellido(),
                ),
            );

            array_push($procesando, $userData);
        }

        $jsonEncoder = new JsonEncoder();
        return $jsonEncoder->encode($procesando, $format = 'json');
    }

    /**
     * 
     *
     * @Route("/grupo", name="ajax_grupo")
     * @Method({"POST"})
     */
    public function grupoAction(Request $request) {
        $id = $request->request->get('id');

        $em = $this->getDoctrine()->getManager();
        $grupos = $em->getRepository('AppBundle:EntericaGrupo')->findByEntericaCapitulo($id);
        $valores = '<option value="" selected="selected">Seleccione</option> ';
        foreach ($grupos as $valor) {
            $valores = $valores . ' <option value=' . $valor->getId() . '>' . $valor->getNombre() . '</option> ';
        }
        return $this->render('ajax/grupo.html.twig', array(
                    'grupos' => $valores,
        ));
    }

    /**
     * 
     *
     * @Route("/elemento", name="ajax_elemento")
     * @Method({"POST"})
     */
    public function elementoAction(Request $request) {
        $id = $request->request->get('id');

        $em = $this->getDoctrine()->getManager();
        $grupos = $em->getRepository('AppBundle:EntericaElemento')->findByEntericaGrupo($id);
        $valores = '<option value="" selected="selected">Seleccione</option> ';
        foreach ($grupos as $valor) {
            $valores = $valores . ' <option value=' . $valor->getId() . '>' . $valor->getNombre() . '</option> ';
        }
        return $this->render('ajax/elemento.html.twig', array(
                    'elementos' => $valores,
        ));
    }

    /**
     * 
     *
     * @Route("/elemento_grupo", name="ajax_elemento_grupo")
     * @Method({"GET", "POST"})
     */
   /* public function elementoGrupoAction(Request $request) {
        $id = $request->request->get('id');

        $em = $this->getDoctrine()->getManager();
        $grupos = $em->getRepository('AppBundle:EntericaElemento')->find(3);
        $valores = '<option value=' . $grupos->getId() . ' selected="selected">' . $grupos->getNombre() . '</option> ';

        return $this->render('ajax/elemento_grupo.html.twig', array(
                    'grupo' => $valores,
        ));
    }
*/
    
    
    /**
     * Filtrar Servicios Profesionales - 
     *
     * @Route("/servicioprofesional", name="ajax_servicioprofesional")
     * @Method({"GET", "POST"})
     */
    public function servicioProfesionalAction(Request $request) {
        $id = $request->request->get('id');

        $conn = $this->getDoctrine()->getManager()->getConnection();

        $sql = 'select * from servicio_profesional as sp left join servicio as s on s.id=sp.servicio_id  left join profesional as p on p.id=sp.profesional_id where s.especialidad_id=:especialidad';
        $stmt = $conn->prepare($sql);

        $stmt->execute(array('especialidad' => $id));

        $servicios = $stmt->fetchAll();

        $valores = '<option value="" selected="selected">Seleccione</option> ';
        $em = $this->getDoctrine()->getManager();
        foreach ($servicios as $valor) {
            $profesional = $em->getRepository('AppBundle:Profesional')->find($valor['profesional_id']);
            $valores = $valores . ' <option value=' . $profesional->getId() . '>' . $profesional->getPersona()->getPrimerNombre() . ' ' . $profesional->getPersona()->getPrimerApellido() . '</option> ';
        }
        return $this->render('ajax/servicioprofesional.html.twig', array(
                    'valores' => $valores,
        ));
    }

    /**
     * 
     *
     * @Route("/medicamentos", name="ajax_medicamento")
     * @Method({ "POST"})
     */
    public function medicamentosAction(Request $request) {
        $id = $request->request->get('id');

        $em = $this->getDoctrine()->getManager();
        $medicamnetos = $em->getRepository('AppBundle:Medicamento')->findByTipoMedicamento($id);
        $valores = '<option value="" selected="selected">Seleccione</option> ';
        foreach ($medicamnetos as $valor) {
            $valores = $valores . ' <option value=' . $valor->getId() . '>' . $valor->getPrincipioActivo() . '</option> ';
        }
        return $this->render('ajax/medicamentos.html.twig', array(
                    'medicamentos' => $valores,
        ));
    }
    
    
     /**
     * 
     *
     * @Route("/insumos", name="ajax_insumo")
     * @Method({"POST"})
     */
    public function insumosAction(Request $request) {
        $id = $request->request->get('id');

        $em = $this->getDoctrine()->getManager();
        $insumos = $em->getRepository('AppBundle:Insumo')->findByTipoInsumo($id);
        $valores = '<option value="" selected="selected">Seleccione</option> ';
        foreach ($insumos as $valor) {
            $valores = $valores . ' <option value=' . $valor->getId() . '>' . $valor->getNombre() . '</option> ';
        }
        return $this->render('ajax/insumos.html.twig', array(
                    'insumos' => $valores,
        ));
    }

}

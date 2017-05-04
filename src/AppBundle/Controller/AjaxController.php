<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Odontograma;

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
     * @Method({ "POST"})
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
     * @Route("/tratamiento", name="ajax_tratamiento")
     * @Method({"POST"})
     */
    public function tratamientoAction(Request $request) {

        $id = $request->request->get('id');
        $diente = $request->request->get('diente');
        $consulta = $request->request->get('consulta');
        //dump($id,$diente, $consulta ); die();

        $em = $this->getDoctrine()->getManager();
        $lista = $em->getRepository('AppBundle:Tratamiento')->findByNombre($id);
        // dump($lista[0]->getId() ); die();
        $this->registrarOdontograma($consulta, $diente, $lista[0]->getId(), $lista[0]->getTodo());

        // encode user to json format
        $userDataAsJson = $this->encodeTratamientoDataToJson($diente, $lista);

        return new JsonResponse([
            'success' => true,
            'data' => [$userDataAsJson]
        ]);
    }

    private function registrarOdontograma($consulta, $diente, $tratamiento, $todoElDiente) {
        $em = $this->getDoctrine()->getManager();
        $tratamiento = $em->getRepository('AppBundle:Tratamiento')->find($tratamiento);
        $consulta = $em->getRepository('AppBundle:Consulta')->find($consulta);
        $miDiente = $em->getRepository('AppBundle:Diente')->findOneByPosicion(substr($diente, -2));

        $odontograma = new Odontograma();
        $odontograma->setConsulta($consulta);
        $odontograma->setDiente($miDiente);
        $oldOdontograma = $em->getRepository('AppBundle:Odontograma')->findOneBy(array('consulta' => $consulta, 'diente' => $miDiente));

        if ($todoElDiente) {

            if (!$oldOdontograma) {
                $odontograma->setCavidad1($tratamiento);
                $odontograma->setCavidad2($tratamiento);
                $odontograma->setCavidad3($tratamiento);
                $odontograma->setCavidad4($tratamiento);
                $odontograma->setCavidad5($tratamiento);
                $em->persist($odontograma);
                $em->flush($odontograma);
            } else {
                $oldOdontograma->setCavidad1($tratamiento);
                $oldOdontograma->setCavidad2($tratamiento);
                $oldOdontograma->setCavidad3($tratamiento);
                $oldOdontograma->setCavidad4($tratamiento);
                $oldOdontograma->setCavidad5($tratamiento);
                $em->persist($oldOdontograma);
                $em->flush($oldOdontograma);
            }
        } else {

            if (!$oldOdontograma) {
                // dump($tratamiento, $odontograma, $oldOdontograma);         die();
                //Verificamos cual es la cavidad            
                switch ($diente[0]) {
                    case('t'): $odontograma->setCavidad1($tratamiento);
                        break;
                    case('r'): $odontograma->setCavidad2($tratamiento);
                        break;
                    case('b'): $odontograma->setCavidad3($tratamiento);
                        break;
                    case('l'): $odontograma->setCavidad4($tratamiento);
                        break;
                    case('c'): $odontograma->setCavidad5($tratamiento);
                        break;
                }
                $em->persist($odontograma);
                $em->flush($odontograma);
            } else {

                //  Existe el Odontograma / Diente
                switch ($diente[0]) {
                    case('t'): $oldOdontograma->setCavidad1($tratamiento);
                        break;
                    case('r'): $oldOdontograma->setCavidad2($tratamiento);
                        break;
                    case('b'): $oldOdontograma->setCavidad3($tratamiento);
                        break;
                    case('l'): $oldOdontograma->setCavidad4($tratamiento);
                        break;
                    case('c'): $oldOdontograma->setCavidad5($tratamiento);
                        break;
                }
                $em->persist($oldOdontograma);
                $em->flush($oldOdontograma);
            }
        }
    }

    /**
     * 
     *
     * @Route("/tratamiento-actualziar", name="ajax_tratamiento_actualizar")
     * @Method({"POST"})
     */
    public function tratamientoActualizarAction(Request $request) {

        $diente = $request->request->get('diente');
        $consulta = $request->request->get('consulta');

        $em = $this->getDoctrine()->getManager();

        $consulta = $em->getRepository('AppBundle:Consulta')->find($consulta);
        $miDiente = $em->getRepository('AppBundle:Diente')->findOneByPosicion(substr($diente, -2));

        $oldOdontograma = $em->getRepository('AppBundle:Odontograma')->findOneBy(array('consulta' => $consulta, 'diente' => $miDiente));
        //dump($oldOdontograma); die();
        //  Existe el Odontograma / Diente
        switch ($diente[0]) {
            case('t'): $tratamiento = $oldOdontograma->getCavidad1();
                break;
            case('r'): $tratamiento = $oldOdontograma->getCavidad2();
                break;
            case('b'): $tratamiento = $oldOdontograma->getCavidad3();
                break;
            case('l'): $tratamiento = $oldOdontograma->getCavidad4();
                break;
            case('c'): $tratamiento = $oldOdontograma->getCavidad5();
                break;
        }
        if ($tratamiento->getTodo()) {

            //Elimino el registro en el odontograma
            $em->remove($oldOdontograma);
            $em->flush($oldOdontograma);
            $oldOdontograma = null;
        } else {

            //Eliminamos la Cavidad en el odontograma
            switch ($diente[0]) {
                case('t'): $oldOdontograma->setCavidad1(null);
                    break;
                case('r'): $oldOdontograma->setCavidad2(null);
                    break;
                case('b'): $oldOdontograma->setCavidad3(null);
                    break;
                case('l'): $oldOdontograma->setCavidad4(null);
                    break;
                case('c'): $oldOdontograma->setCavidad5(null);
                    break;
            }

            if ($oldOdontograma->getCavidad1() == null && $oldOdontograma->getCavidad2() == null && $oldOdontograma->getCavidad3() == null && $oldOdontograma->getCavidad4() == null && $oldOdontograma->getCavidad5() == null) {
                $em->remove($oldOdontograma);
            } else {
                $em->persist($oldOdontograma);
            }

            $em->flush($oldOdontograma);
        }

        $procesando = array();

        $odontogramaData = array(
            'diente' => $miDiente->getPosicion(),
            'tipo' => $miDiente->getIdentificador(),
            'cavidad1' => ( $oldOdontograma !== null && $oldOdontograma->getCavidad1() !== null ) ? $oldOdontograma->getCavidad1()->getColor() : '#FFFFFF',
            'cavidad2' => ( $oldOdontograma !== null && $oldOdontograma->getCavidad2() !== null ) ? $oldOdontograma->getCavidad2()->getColor() : '#FFFFFF',
            'cavidad3' => ( $oldOdontograma !== null && $oldOdontograma->getCavidad3() !== null ) ? $oldOdontograma->getCavidad3()->getColor() : '#FFFFFF',
            'cavidad4' => ( $oldOdontograma !== null && $oldOdontograma->getCavidad4() !== null ) ? $oldOdontograma->getCavidad4()->getColor() : '#FFFFFF',
            'cavidad5' => ( $oldOdontograma !== null && $oldOdontograma->getCavidad5() !== null ) ? $oldOdontograma->getCavidad5()->getColor() : '#FFFFFF',
        );

        array_push($procesando, $odontogramaData);


        $odontograma = json_encode($procesando);
        //dump($odontograma); die();

        return new JsonResponse([
            'success' => true,
            'data' => [$odontograma]
        ]);
    }

    private function encodeTratamientoDataToJson($diente, Array $valor) {
        $procesando = array();
        foreach ($valor as &$lista) {
            $tratamientoData = array(
                'id' => $lista->getId(),
                'nombre' => $lista->getNombre(),
                'color' => $lista->getColor(),
                'cavidad' => $lista->getCavidad(),
                'todo' => $lista->getTodo(),
                'diente' => $diente,
            );

            array_push($procesando, $tratamientoData);
        }

        $jsonEncoder = new JsonEncoder();
        return $jsonEncoder->encode($procesando, $format = 'json');
    }

    /**
     * 
     *
     * @Route("/pintar-odontograma", name="ajax_pintarOdontograma")
     * @Method({ "POST"})
     */
    public function pintarOdontograma(Request $request) {
        $consulta = $request->request->get('consulta');
        $em = $this->getDoctrine()->getManager();
        //Buscar los Odontogramas asociado a la Consulta
        $odontograma = $em->getRepository('AppBundle:Odontograma')->findBy(array('consulta' => $consulta,));


        $procesando = array();
        foreach ($odontograma as &$valor) {
            $odontogramaData = array(
                'diente' => $valor->getDiente()->getPosicion(),
                'tipo' => $valor->getDiente()->getIdentificador(),
                'cavidad1' => ($valor->getCavidad1() !== null) ? $valor->getCavidad1()->getColor() : '#FFFFFF',
                'cavidad2' => ($valor->getCavidad2() !== null) ? $valor->getCavidad2()->getColor() : '#FFFFFF',
                'cavidad3' => ($valor->getCavidad3() !== null) ? $valor->getCavidad3()->getColor() : '#FFFFFF',
                'cavidad4' => ($valor->getCavidad4() !== null) ? $valor->getCavidad4()->getColor() : '#FFFFFF',
                'cavidad5' => ($valor->getCavidad5() !== null) ? $valor->getCavidad5()->getColor() : '#FFFFFF',
            );

            array_push($procesando, $odontogramaData);
        }

        $odontograma = json_encode($procesando);
        //dump($odontograma); die();
        return new JsonResponse([
            'success' => true,
            'data' => [$odontograma]
        ]);
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

<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;

//use Symfony\Bridge\Doctrine\Form\Type\EntityType;

/**
 * Estadistica controller.
 *
 * @Route("estadistica")
 */
class EstadisticaController extends Controller {

    /**
     * Lista de todas las Estadisticas.
     *
     * @Route("/", name="estadistica_index")
     * @Method("GET")
     */
    public function indexAction() {

        return $this->render('estadistica/index.html.twig', array(
        ));
    }

    /**
     * Estadisticas por Consultas.
     *
     * @Route("/consulta", name="estadistica_consulta")
     * @Method({"GET", "POST"})
     */
    public function consultaAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $consulta = NULL;
        $consultaDatos = NULL;
        $salida = '';
        $rangos = '';
        if ($request->isMethod('POST')) {
            $var = $request->request->get('form');
            $rango = explode("-", $var['daterange']);
            $contador = 'SELECT p.comunidad, COUNT(c.id)  FROM consulta as c left join paciente as p on p.id=c.paciente_id where c.egreso=:egreso and c.fecha BETWEEN (:desde) AND (:hasta) GROUP BY p.comunidad';
            $datos = "SELECT pers.nacionalidad,pers.cedula, pers.primer_apellido as persona_apellido, pers.primer_nombre as persona_nombre, p.comunidad, pers.genero, e.nombre as especialidad, perso.primer_nombre as profesional_nombre, pers.primer_apellido as profesional_apellido, c.fecha FROM consulta as c
                        left join paciente as p on p.id=c.paciente_id
                        left join especialidad as e on e.id=c.especialidad_id
                        left join persona as pers on pers.id=p.persona_id
                        left join profesional as prof on prof.id=c.profesional_id
                        left join persona as perso on perso.id=prof.persona_id
                        where c.egreso=:egreso and c.fecha BETWEEN (:desde) AND (:hasta)";
            $parametros = array('egreso' => true, 'desde' => trim($rango[0]), 'hasta' => trim($rango[1]));
            $consulta = $this->ejecutarQuery($contador, $parametros);
            $consultaDatos = $this->ejecutarQuery($datos, $parametros);
            foreach ($consulta as &$valor) {
                $salida = $salida . " {label: '" . ucwords($valor['comunidad']) . "', value:" . $valor['count'] . "},";
            }
        }

        if (!$consulta) {
            $hoy = new \DateTime('now');
            $hoy->setTime(6, 0, 0);
            $rangos = $hoy->format('d/m/y h:i A');
            $rangos = $rangos . ' - ' . $rangos;
        } else {
            $rangos = $request->request->get('daterange');
        }

        //Creamos el formulario de Consulta
        $form = $this->crearFormulario("estadistica_consulta", $rangos);
        $form->handleRequest($request);
        return $this->render('estadistica/consulta.html.twig', array(
                    'consultas' => $salida,
                    'consultaDatos' => $consultaDatos,
                    'rango' => $rangos,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Estadisticas por Medicamentos Suministrados.
     *
     * @Route("/medicamento", name="estadistica_medicamento")
     * @Method({"GET", "POST"})
     */
    public function medicamentoAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $consulta = NULL;
        $consultaDatos = NULL;
        $salida = '';
        $rangos = '';

        if ($request->isMethod('POST')) {
            $var = $request->request->get('form');
            $rango = explode("-", $var['daterange']);
            $contador = 'SELECT  ms.medicamento_id as medicamento, COUNT(ms.id)  FROM medicamento_suministrado as ms        
		left join consulta as c on c.id = ms.consulta_id
                where c.egreso=:egreso and ms.fecha BETWEEN (:desde) AND (:hasta)		
		GROUP BY ms.medicamento_id';
            $datos = "SELECT  tm.nombre as tipo, m.principio_activo as medicamento, ms.via_administracion, ms.cantidad, ms.fecha, per.nacionalidad, 
                        per.cedula, per.primer_apellido, per.primer_nombre, 
                        perso.nacionalidad as persona_nacionalidad, perso.cedula as persona_cedula, perso.primer_apellido as persona_apellido, perso.primer_nombre as persona_nombre 
                        FROM medicamento_suministrado as ms        
                        left join consulta as c on c.id = ms.consulta_id
                        left join medicamento as m on m.id = ms.medicamento_id
                        left join profesional as prof on prof.id = c.profesional_id
                        left join persona as per on per.id = prof.persona_id
                        left join paciente as p on p.id=c.paciente_id
                        left join persona as perso on perso.id=p.persona_id
                        left join tipos_medicamento as tm on tm.id = m.tipo_medicamento_id                        
                        where c.egreso=:egreso and c.fecha BETWEEN (:desde) AND (:hasta)";
            $parametros = array('egreso' => true, 'desde' => trim($rango[0]), 'hasta' => trim($rango[1]));
            $consulta = $this->ejecutarQuery($contador, $parametros);
            $consultaDatos = $this->ejecutarQuery($datos, $parametros);
            //dump($consultaDatos); die();
            $em = $this->getDoctrine()->getManager();
            foreach ($consulta as &$valor) {
                $medicamento = $em->getRepository('AppBundle:Medicamento')->find($valor['medicamento']);
                
                $salida = $salida . " {medicamento: '" . ucwords($medicamento->getPrincipioActivo()) . "', Cantidad:" . $valor['count'] . "},";
            }
        }

        if (!$consulta) {
            $hoy = new \DateTime('now');
            $hoy->setTime(6, 0, 0);
            $rangos = $hoy->format('d/m/y h:i A');
            $rangos = $rangos . ' - ' . $rangos;
        } else {
            $rangos = $request->request->get('daterange');
        }

        //Creamos el formulario de Consulta
        $form = $this->crearFormulario("estadistica_medicamento", $rangos);
        $form->handleRequest($request);

        return $this->render('estadistica/medicamento.html.twig', array(
                    'consultas' => $salida,
                    'consultaDatos' => $consultaDatos,
                    'rango' => $rangos,
                    'form' => $form->createView(),
        ));
    }
    
    /**
     * Estadisticas por Insumos Suministrados.
     *
     * @Route("/insumo", name="estadistica_insumo")
     * @Method({"GET", "POST"})
     */
    public function insumoAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $consulta = NULL;
        $consultaDatos = NULL;
        $salida = '';
        $rangos = '';

        if ($request->isMethod('POST')) {
            $var = $request->request->get('form');
            $rango = explode("-", $var['daterange']);
            $contador = 'SELECT  ms.insumo_id as insumo, COUNT(ms.id)  FROM insumo_suministrado as ms left join consulta as c on c.id = ms.consulta_id where c.egreso=:egreso and ms.fecha BETWEEN (:desde) AND (:hasta) GROUP BY ms.insumo_id';
            $datos = "SELECT  tm.nombre as tipo, m.nombre as insumo, ms.cantidad, ms.fecha, per.nacionalidad, 
                        per.cedula, per.primer_apellido, per.primer_nombre, 
                        perso.nacionalidad as persona_nacionalidad, perso.cedula as persona_cedula, perso.primer_apellido as persona_apellido, perso.primer_nombre as persona_nombre 
                        FROM insumo_suministrado as ms        
                        left join consulta as c on c.id = ms.consulta_id
                        left join insumo as m on m.id = ms.insumo_id
                        left join profesional as prof on prof.id = c.profesional_id
                        left join persona as per on per.id = prof.persona_id
                        left join paciente as p on p.id=c.paciente_id
                        left join persona as perso on perso.id=p.persona_id
                        left join tipos_insumo as tm on tm.id = m.tipo_insumo_id
                        where c.egreso=:egreso and c.fecha BETWEEN (:desde) AND (:hasta)";
            $parametros = array('egreso' => true, 'desde' => trim($rango[0]), 'hasta' => trim($rango[1]));
            $consulta = $this->ejecutarQuery($contador, $parametros);
            $consultaDatos = $this->ejecutarQuery($datos, $parametros);
            
            $em = $this->getDoctrine()->getManager();
            foreach ($consulta as &$valor) {
                $medicamento = $em->getRepository('AppBundle:Insumo')->find($valor['insumo']);                
                $salida = $salida . " {medicamento: '" . ucwords($medicamento->getNombre()) . "', Cantidad:" . $valor['count'] . "},";
            }
           // dump($salida); die();
        }

        if (!$consulta) {
            $hoy = new \DateTime('now');
            $hoy->setTime(6, 0, 0);
            $rangos = $hoy->format('d/m/y h:i A');
            $rangos = $rangos . ' - ' . $rangos;
        } else {
            $rangos = $request->request->get('daterange');
        }

        //Creamos el formulario de Consulta
        $form = $this->crearFormulario("estadistica_insumo", $rangos);
        $form->handleRequest($request);

        return $this->render('estadistica/insumo.html.twig', array(
                    'consultas' => $salida,
                    'consultaDatos' => $consultaDatos,
                    'rango' => $rangos,
                    'form' => $form->createView(),
        ));
    }
    
    
    /**
     * Estadisticas por Signos Vitales Suministrados.
     *
     * @Route("/signo", name="estadistica_signo")
     * @Method({"GET", "POST"})
     */
    public function signoAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $consulta = NULL;
        $consultaDatos = NULL;
        $salida = '';
        $rangos = '';

        if ($request->isMethod('POST')) {
            $var = $request->request->get('form');
            $rango = explode("-", $var['daterange']);
            $contador = 'SELECT  ms.nombre as signo, COUNT(ms.id) FROM signos_vitales_suministrados as ms left join consulta as c on c.id = ms.consulta_id where c.egreso=:egreso and ms.fecha BETWEEN (:desde) AND (:hasta) GROUP BY ms.id';
            $datos = "SELECT perso.nacionalidad as persona_nacionalidad, perso.cedula as persona_cedula, perso.primer_apellido as persona_apellido, perso.primer_nombre as persona_nombre,
                        ms.nombre, ms.valor, per.nacionalidad, per.cedula, per.primer_apellido, per.primer_nombre, ms.fecha 
                        FROM signos_vitales_suministrados as ms        
                        left join consulta as c on c.id = ms.consulta_id                       
                        left join profesional as prof on prof.id = c.profesional_id
                        left join persona as per on per.id = prof.persona_id
                        left join paciente as p on p.id=c.paciente_id
                        left join persona as perso on perso.id=p.persona_id   
                        where c.egreso=:egreso and c.fecha BETWEEN (:desde) AND (:hasta)";
            $parametros = array('egreso' => true, 'desde' => trim($rango[0]), 'hasta' => trim($rango[1]));
            $consulta = $this->ejecutarQuery($contador, $parametros);
            $consultaDatos = $this->ejecutarQuery($datos, $parametros);
            
            
            foreach ($consulta as &$valor) {
                               
                $salida = $salida . " {Signo: '" . ucwords($valor['signo']) . "', Cantidad:" . $valor['count'] . "},";
            }
           // dump($salida); die();
        }

        if (!$consulta) {
            $hoy = new \DateTime('now');
            $hoy->setTime(6, 0, 0);
            $rangos = $hoy->format('d/m/y h:i A');
            $rangos = $rangos . ' - ' . $rangos;
        } else {
            $rangos = $request->request->get('daterange');
        }

        //Creamos el formulario de Consulta
        $form = $this->crearFormulario("estadistica_signo", $rangos);
        $form->handleRequest($request);

        return $this->render('estadistica/signo.html.twig', array(
                    'consultas' => $salida,
                    'consultaDatos' => $consultaDatos,
                    'rango' => $rangos,
                    'form' => $form->createView(),
        ));
    }
    
    /**
     * Estadisticas por Observaciones Suministrados.
     *
     * @Route("/observacion", name="estadistica_observacion")
     * @Method({"GET", "POST"})
     */
    public function observacionAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $consulta = NULL;
        $consultaDatos = NULL;
        $salida = '';
        $rangos = '';

        if ($request->isMethod('POST')) {
            $var = $request->request->get('form');
            $rango = explode("-", $var['daterange']);
            $contador = 'SELECT  ms.tipo as observacion, COUNT(ms.id) FROM observacion as ms left join consulta as c on c.id = ms.consulta_id where c.egreso=:egreso and c.fecha BETWEEN (:desde) AND (:hasta) GROUP BY ms.id';
            $datos = "SELECT  
                        perso.nacionalidad as persona_nacionalidad, perso.cedula as persona_cedula, perso.primer_apellido as persona_apellido, perso.primer_nombre as persona_nombre,
                        ms.tipo, ms.descripcion, per.nacionalidad, per.cedula, per.primer_apellido, per.primer_nombre, ms.fecha 
                        FROM observacion as ms        
                        left join consulta as c on c.id = ms.consulta_id                       
                        left join profesional as prof on prof.id = c.profesional_id
                        left join persona as per on per.id = prof.persona_id
                        left join paciente as p on p.id=c.paciente_id
                        left join persona as perso on perso.id=p.persona_id   
                        where c.egreso=:egreso and c.fecha BETWEEN (:desde) AND (:hasta)";
            $parametros = array('egreso' => true, 'desde' => trim($rango[0]), 'hasta' => trim($rango[1]));
            $consulta = $this->ejecutarQuery($contador, $parametros);
            $consultaDatos = $this->ejecutarQuery($datos, $parametros);
           
            
            foreach ($consulta as &$valor) {                               
                $salida = $salida . " {Tipo: '" . ucwords($valor['observacion']) . "', Cantidad:" . $valor['count'] . "},";
            }
           //dump($salida); die();
        }

        if (!$consulta) {
            $hoy = new \DateTime('now');
            $hoy->setTime(6, 0, 0);
            $rangos = $hoy->format('d/m/y h:i A');
            $rangos = $rangos . ' - ' . $rangos;
        } else {
            $rangos = $request->request->get('daterange');
        }

        //Creamos el formulario de Consulta
        $form = $this->crearFormulario("estadistica_observacion", $rangos);
        $form->handleRequest($request);

        return $this->render('estadistica/observacion.html.twig', array(
                    'consultas' => $salida,
                    'consultaDatos' => $consultaDatos,
                    'rango' => $rangos,
                    'form' => $form->createView(),
        ));
    }
    
    /**
     * Estadisticas por Observaciones Suministrados.
     *
     * @Route("/odontologia", name="estadistica_odontologia")
     * @Method({"GET", "POST"})
     */
    public function odontologiaAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $consulta = NULL;
        $consultaDatos = NULL;
        $salida = '';
        $rangos = '';

        if ($request->isMethod('POST')) {
            $var = $request->request->get('form');
            $rango = explode("-", $var['daterange']);
            //$contador = 'SELECT  ms.tipo as observacion, COUNT(ms.id) FROM observacion as ms left join consulta as c on c.id = ms.consulta_id where c.egreso=:egreso and c.fecha BETWEEN (:desde) AND (:hasta) GROUP BY ms.id';
            $datos = "select d.posicion, d.nombre, t1.nombre as cavidad1, t2.nombre as cavidad2, t3.nombre as cavidad3, t4.nombre as cavidad4, t5.nombre as cavidad5,  c.fecha, 
                        per.nacionalidad, per.cedula, per.primer_apellido, per.primer_nombre, perso.nacionalidad as persona_nacionalidad, perso.cedula as persona_cedula, perso.primer_apellido as persona_apellido, perso.primer_nombre as persona_nombre
                        from odontograma as e
                        left join diente as d on e.diente_id=d.id
                        left join tratamiento as t1 on e.cavidad_1=t1.id
                        left join tratamiento as t2 on e.cavidad_2=t2.id
                        left join tratamiento as t3 on e.cavidad_3=t3.id
                        left join tratamiento as t4 on e.cavidad_4=t4.id
                        left join tratamiento as t5 on e.cavidad_5=t5.id
                        left join consulta as c on e.consulta_id=c.id
                        left join profesional as p on  p.id=c.profesional_id
                        left join persona as per on p.persona_id=per.id
                        left join paciente as pac on pac.id=c.paciente_id
                        left join persona as perso on perso.id=pac.persona_id 
                        where c.egreso=:egreso and c.fecha BETWEEN (:desde) AND (:hasta) ";
            $parametros = array('egreso' => true, 'desde' => trim($rango[0]), 'hasta' => trim($rango[1]));
            
            $consultaDatos = $this->ejecutarQuery($datos, $parametros);
            //dump($consultaDatos); die();
            /*$consulta = $this->ejecutarQuery($contador, $parametros);          
            foreach ($consulta as &$valor) {                               
                $salida = $salida . " {Tipo: '" . ucwords($valor['observacion']) . "', Cantidad:" . $valor['count'] . "},";
            }*/
           
        }

        if (!$consulta) {
            $hoy = new \DateTime('now');
            $hoy->setTime(6, 0, 0);
            $rangos = $hoy->format('d/m/y h:i A');
            $rangos = $rangos . ' - ' . $rangos;
        } else {
            $rangos = $request->request->get('daterange');
        }

        //Creamos el formulario de Consulta
        $form = $this->crearFormulario("estadistica_odontologia", $rangos);
        $form->handleRequest($request);

        return $this->render('estadistica/odontologia.html.twig', array(
                  //'consultas' => $salida,
                    'consultaDatos' => $consultaDatos,
                    'rango' => $rangos,
                    'form' => $form->createView(),
        ));
    }

    private function crearFormulario($url, $rangos) {
        $form = $this->createFormBuilder()
                ->setAction($this->generateUrl($url))
                ->add('daterange', TextType::class, array(
                    'label' => 'Rango de Fecha',
                    'required' => true,
                    'attr' => array('placeholder' => $rangos),
                ))
                ->getForm();
        return $form;
    }

    private function ejecutarQuery($sql, $parametros) {
        $conn = $this->getDoctrine()->getManager()->getConnection();
        $stmt = $conn->prepare($sql);
        $stmt->execute($parametros);
        return $stmt->fetchAll();
    }

}

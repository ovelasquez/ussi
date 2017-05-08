<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Estadistica controller.
 *
 * @Route("estadistica")
 */
class EstadisticaController extends Controller {

    /**
     * Lists all Estadisticas.
     *
     * @Route("/", name="estadistica_index")
     * @Method({"GET", "POST"})
     */
    public function indexAction(Request $request) {
        $consulta = NULL;
        $consultaDatos= NULL;
        $salida = '';
        $rangos = '';

        if ($request->request->get('daterange')) {
            $rango = explode("-", $request->request->get('daterange'));
            $consulta = $this->comunidadConsulta($rango);
            $consultaDatos = $this->comunidadConsultaDatos($rango);

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
        return $this->render('estadistica/index.html.twig', array('consultas' => $salida, 'consultaDatos'=>$consultaDatos ,'rango' => $rangos,));
    }

    private function comunidadConsulta($rango) {

        $conn = $this->getDoctrine()->getManager()->getConnection();
        $sql = '
            SELECT p.comunidad, COUNT(c.id)  FROM consulta as c
            left join paciente as p on p.id=c.paciente_id 
            where c.fecha BETWEEN (:desde) AND (:hasta) 
            GROUP BY p.comunidad
            ';
        $stmt = $conn->prepare($sql);
        $stmt->execute(array('desde' => trim($rango[0]), 'hasta' => trim($rango[1])));
        return $stmt->fetchAll();
    }

    private function comunidadConsultaDatos($rango) {

        $conn = $this->getDoctrine()->getManager()->getConnection();
        $sql = '
            SELECT pers.nacionalidad,pers.cedula, pers.primer_apellido as persona_apellido, pers.primer_nombre as persona_nombre, p.comunidad, pers.genero, e.nombre as especialidad, perso.primer_nombre as profesional_nombre, pers.primer_apellido as profesional_apellido, c.fecha FROM consulta as c
            left join paciente as p on p.id=c.paciente_id
            left join especialidad as e on e.id=c.especialidad_id
            left join persona as pers on pers.id=p.persona_id
            left join profesional as prof on prof.id=c.profesional_id
            left join persona as perso on perso.id=prof.persona_id
            where c.fecha BETWEEN (:desde) AND (:hasta)
            ';
        $stmt = $conn->prepare($sql);
        $stmt->execute(array('desde' => trim($rango[0]), 'hasta' => trim($rango[1])));
        return $stmt->fetchAll();
    }

}

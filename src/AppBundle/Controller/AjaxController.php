<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Esperando;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\HttpFoundation\JsonResponse;

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

        $lista = $em->getRepository('AppBundle:Esperando')->findOneByStatus('procesando');

        // encode user to json format
        $userDataAsJson = $this->encodeUserDataToJson($lista);

        //dump($userDataAsJson);   die();
        //return $this->render('ajax/estanLlamado.html.twig', array('lista' => json_encode($lista)));

        return new JsonResponse([
            'success' => true,
            'data' => [$userDataAsJson] // Your data here
        ]);

        //return array('userDataAsJson' => $userDataAsJson  );
    }

    private function encodeUserDataToJson(Esperando $lista) {
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
            
        );

        $jsonEncoder = new JsonEncoder();
        return $jsonEncoder->encode($userData, $format = 'json');
    }

}

<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
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

        $lista = $em->getRepository('AppBundle:Esperando')->findOneByStatus('procesando');
        //dump($lista); die();

        return $this->render('ajax/estanLlamado.html.twig', array('lista' => $lista->getPosicion(),));
    }

    /**
     * 
     *
     * @Route("/estanLlamando", name="ajax_alertaLlamando")
     * @Method({"GET", "POST"})
     */
    public function alertaLlamandoAction() {
        $em = $this->getDoctrine()->getManager();

        $lista = $em->getRepository('AppBundle:Disponible')->findOneByStatus('procesando');
        //dump($lista); die();

        return $this->render('ajax/alertaLlamado.html.twig', array('lista' => $lista->getPosicion(),));
    }

}

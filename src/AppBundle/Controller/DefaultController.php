<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller {

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $hoy = new \DateTime('now');
        $hoy->setTime(0, 0, 0);

        $configuracion = $em->getRepository('AppBundle:Configuracion')->findAll();
        $repository = $em->getRepository('AppBundle:Esperando');
        $query = $repository->createQueryBuilder('p')
                ->where('p.fechaRegistro >= :hoy')
                ->setParameter('hoy', $hoy)
                ->orderBy('p.posicion', 'ASC')
                ->getQuery();
        $esperandos = $query->getResult();

        $medicos = $em->getRepository('AppBundle:Cita')->findAllByServiosProfesionalesTodos(date("w")); //Lista Medicos
        $especialidades = $em->getRepository('AppBundle:Servicio')->findByDia(date("w"));
        $servicioProfesionals = $em->getRepository('AppBundle:ServicioProfesional')->findAll();


        //dump($esperandos);   die();
        // replace this example code with whatever you need
        //return $this->render('default/index.html.twig', ['base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,]);

        return $this->render('default/recepcion.html.twig', array(
                    'esperandos' => $esperandos,
                    'medicos' => $medicos,
                    'especialidades' => $especialidades,
                    'servicioProfesionals' => $servicioProfesionals,
                    'penalizacion' => $configuracion[0]->getPenalizacion(),
        ));
    }

}

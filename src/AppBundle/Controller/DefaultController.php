<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

//use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller {

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction() {

        if (in_array('ROLE_MEDICO', $this->getUser()->getRoles())) {
            return $this->redirectToRoute('homepage_medico');
        } elseif (in_array('ROLE_RECEPCION', $this->getUser()->getRoles())) {
            return $this->redirectToRoute('homepage_recepcion');
        }


        return $this->render('default/index.html.twig', ['base_dir' => realpath($this->getParameter('kernel.root_dir') . '/..') . DIRECTORY_SEPARATOR,]);
    }

    /**
     * @Route("/homepage_recepcion", name="homepage_recepcion")
     */
    public function recepcionAction() {
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
        $esperandos = $query->getResult(); //Lista de Espera
        $medicos = $em->getRepository('AppBundle:Cita')->findAllByServiosProfesionalesTodos(date("w")); //Lista Medicos
        $especialidades = $em->getRepository('AppBundle:Servicio')->findByDia(date("w"));               // Lista de Especialidades
        $servicioProfesionals = $em->getRepository('AppBundle:Cita')->findAllByServiosProfesionales(date("w"));         //Lista

        return $this->render('default/recepcion.html.twig', array(
                    'esperandos' => $esperandos,
                    'medicos' => $medicos,
                    'especialidades' => $especialidades,
                    'servicioProfesionals' => $servicioProfesionals,
                    'penalizacion' => $configuracion[0]->getPenalizacion(),
        ));
    }

    /**
     * @Route("/homepage_medico", name="homepage_medico")
     */
    public function medicoAction() {
        $em = $this->getDoctrine()->getManager();
        $hoy = new \DateTime('now');
        $hoy->setTime(0, 0, 0);
        $configuracion = $em->getRepository('AppBundle:Configuracion')->findAll();
        $especialidad = $em->getRepository('AppBundle:Especialidad')->findOneByNombre('Pediatría');
        $repository = $em->getRepository('AppBundle:Esperando');
        $query = $repository->createQueryBuilder('p')
                ->where('p.fechaRegistro >= :hoy')
                ->andWhere('p.especialidad = :miEspecialidad')
                ->setParameter('hoy', $hoy)
                ->setParameter('miEspecialidad', $especialidad)
                ->orderBy('p.posicion', 'ASC')
                ->getQuery();
        $esperandos = $query->getResult(); //Lista de Espera

        return $this->render('default/medico.html.twig', array(
                    'esperandos' => $esperandos,
                    'penalizacion' => $configuracion[0]->getPenalizacion(),
        ));
    }

}

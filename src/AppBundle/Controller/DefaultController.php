<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Campania;

//use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller {

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction() {

        if (in_array('ROLE_RECEPCION', $this->getUser()->getRoles())) {
            return $this->redirectToRoute('homepage_recepcion');
        } elseif (in_array('ROLE_MEDICO', $this->getUser()->getRoles())) {
            return $this->redirectToRoute('homepage_medico');
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
        $medicos = $em->getRepository('AppBundle:Cita')->findAllByServiosProfesionalesTodos(date("w"));             // Lista Medicos
        $especialidades = $em->getRepository('AppBundle:Servicio')->findByDia(date("w"));                           // Lista de Especialidades
        $servicioProfesionals = $em->getRepository('AppBundle:Cita')->findAllByServiosProfesionales(date("w"));     // Lista
        //dump($servicioProfesionals); die();

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
        $esperandos = null;
        $configuracion = $em->getRepository('AppBundle:Configuracion')->findAll();
        $profesional = $em->getRepository('AppBundle:Profesional')->findOneByPersona($this->getUser()->getPersona());
        $servicioProfesional = $em->getRepository('AppBundle:ServicioProfesional')->findOneBy(array('profesional' => $profesional, 'status' => 'activo'));
        if ($servicioProfesional) {

            $especialidad = $em->getRepository('AppBundle:Especialidad')->find($servicioProfesional->getServicio()->getEspecialidad());
            //dump($especialidad); die();
            $repository = $em->getRepository('AppBundle:Esperando');
            $query = $repository->createQueryBuilder('p')
                    ->where('p.fechaRegistro >= :hoy')
                    ->andWhere('p.especialidad = :especialidad')
                    ->setParameter('hoy', $hoy)
                    ->setParameter('especialidad', $especialidad)
                    ->orderBy('p.posicion', 'ASC')
                    ->getQuery();
            $esperandos = $query->getResult(); //Lista de Espera
        }
        // dump($esperandos); die();

        return $this->render('default/medico.html.twig', array(
                    'esperandos' => $esperandos,
                    'penalizacion' => $configuracion[0]->getPenalizacion(),
        ));
    }

    /**
     * @Route("/sala", name="homepage_sala")
     */
    public function salaAction() {
        $em = $this->getDoctrine()->getManager();
        $configuracion = $em->getRepository('AppBundle:Configuracion')->findAll();                
        $campania=new Campania();
        
        $campania= $configuracion[0]->getCampania();
        $campanium=$campania->getImagen()->getValues();
        asort($campanium);
        //dump($campanium); die();
     

        return $this->render('sala/index.html.twig', array('campanium'=>$campanium));
    }

}

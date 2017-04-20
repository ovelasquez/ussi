<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
<<<<<<< HEAD
use AppBundle\Entity\Campania;

//use Symfony\Component\HttpFoundation\Request;
=======
use Symfony\Component\HttpFoundation\Session\Session;
>>>>>>> 14ff9821ce0fa370431a23dccd4c2f82c4184115

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
<<<<<<< HEAD

            $especialidad = $em->getRepository('AppBundle:Especialidad')->find($servicioProfesional->getServicio()->getEspecialidad());
            //dump($especialidad); die();
=======
            $especialidad = $em->getRepository('AppBundle:Especialidad')->find($servicioProfesional->getServicio()->getEspecialidad());
            //Arma la lista de espera
>>>>>>> 14ff9821ce0fa370431a23dccd4c2f82c4184115
            $repository = $em->getRepository('AppBundle:Esperando');
            $query = $repository->createQueryBuilder('p')
                    ->where('p.fechaRegistro >= :hoy')
                    ->andWhere('p.especialidad = :especialidad')
<<<<<<< HEAD
                    ->setParameter('hoy', $hoy)
                    ->setParameter('especialidad', $especialidad)
=======
                    ->andWhere('p.status = :activo')
                    ->setParameter('hoy', $hoy)
                    ->setParameter('especialidad', $especialidad)
                    ->setParameter('activo', 'activo')
>>>>>>> 14ff9821ce0fa370431a23dccd4c2f82c4184115
                    ->orderBy('p.posicion', 'ASC')
                    ->getQuery();
            $esperandos = $query->getResult(); //Lista de Espera
        }
<<<<<<< HEAD
        // dump($esperandos); die();

=======
>>>>>>> 14ff9821ce0fa370431a23dccd4c2f82c4184115
        return $this->render('default/medico.html.twig', array(
                    'esperandos' => $esperandos,
                    'penalizacion' => $configuracion[0]->getPenalizacion(),
        ));
    }

    /**
<<<<<<< HEAD
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
=======
     * @Route("/homepage_consulta/{paciente}", name="homepage_consulta")
     */
    public function consultaAction($paciente) {
        $em = $this->getDoctrine()->getManager();
        $paciente = $em->getRepository('AppBundle:Paciente')->find($paciente);

        // Buscamos si el Paciente tiene Historia Medica
        $historicoAntecedentes = $em->getRepository('AppBundle:Antecedente')->findByPaciente($paciente);
        $sicobiologicos = $em->getRepository('AppBundle:Sicobiologico')->findByPaciente($paciente);
        $patologias = $em->getRepository('AppBundle:Patologia')->findByPaciente($paciente);
        $sexualidads = $em->getRepository('AppBundle:Sexualidad')->findByPaciente($paciente);
        $perinatals = $em->getRepository('AppBundle:Perinatal')->findByPaciente($paciente);
        $profesional = $em->getRepository('AppBundle:Profesional')->findOneByPersona($this->getUser()->getPersona());
        $ServicioProfesional = $em->getRepository('AppBundle:ServicioProfesional')->findByProfesional($profesional);
        foreach ($ServicioProfesional as &$valor) {
            if ($valor->getServicio()->getDia() == date("w") && $valor->getStatus() == 'activo') {
                $especialidad = $valor->getServicio()->getEspecialidad();
            }
        }
       // $historicoEvolucion = $em->getRepository('AppBundle:Evolucion')->findAllByConsulta($paciente->getId(),$especialidad->getId() );
       // dump($historicoEvolucion);die();
        $evolucion = null;
        $afeccione = null;

        $tieneConsultaActiva = $em->getRepository('AppBundle:Consulta')->findOneBy(
                array('paciente' => $paciente,
                    'egreso' => false,
                    'profesional' => $profesional,
                    'especialidad' => $especialidad)
        );


        if ($tieneConsultaActiva) {
            $consulta = $tieneConsultaActiva;

            //Buscar la Evolucion asociada a la Consulta
            $evolucion = $em->getRepository('AppBundle:Evolucion')->findOneBy(
                    array('consulta' => $tieneConsultaActiva,));

            //Buscar las Afeccione asociada a la consulta
            $afeccione = $em->getRepository('AppBundle:Afeccione')->findOneBy(
                    array('consulta' => $tieneConsultaActiva,)
            );
        } else {

            //Creamos una nueva consulta
            if (in_array('ROLE_MEDICO', $this->getUser()->getRoles()) && $especialidad) {
                $consulta = new \AppBundle\Entity\Consulta;
                $consulta->setFecha(new \DateTime('now'));
                $consulta->setEgreso(FALSE);
                $consulta->setPaciente($paciente);
                $consulta->setProfesional($profesional);
                $consulta->setEspecialidad($especialidad);
                $em->persist($consulta);
                $em->flush($consulta);
            }
        }

        return $this->render('default/consulta.html.twig', array(
                    'paciente' => $paciente,
                    'historicoAntecedentes' => $historicoAntecedentes,
                    'sicobiologicos' => $sicobiologicos,
                    'patologias' => $patologias,
                    'sexualidads' => $sexualidads,
                    'perinatals' => $perinatals,
                    'consulta' => $consulta,
                    'evolucion' => $evolucion,
                    'afeccione' => $afeccione,
                   // 'historicoEvolucion' => $historicoEvolucion,
        ));
    }

    /**
     * @Route("/sala", name="homepage_sala")
     */
    public function salaAction() {

        return $this->render('sala/index.html.twig');
>>>>>>> 14ff9821ce0fa370431a23dccd4c2f82c4184115
    }

}

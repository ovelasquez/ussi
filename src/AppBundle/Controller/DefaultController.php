<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Campania;
use AppBundle\Entity\Consulta;

class DefaultController extends Controller {

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction() {
        switch ($this->getUser()->getRoles()[0]) {
            case('ROLE_RECEPCION'): return $this->redirectToRoute('homepage_recepcion');
                break;
            case('ROLE_MEDICO'): return $this->redirectToRoute('homepage_medico');
                break;
            default: return $this->render('default/index.html.twig', ['base_dir' => realpath($this->getParameter('kernel.root_dir') . '/..') . DIRECTORY_SEPARATOR,]);
        }
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


        return $this->render('default/recepcion.html.twig', array(
                    'esperandos' => $esperandos,
                    'medicos' => $medicos,
                    'especialidades' => $especialidades,
                    'servicioProfesionals' => $servicioProfesionals,
                    'penalizacion' => $configuracion[0]->getPenalizacion(),));
    }

    /**
     * @Route("/homepage_medico", name="homepage_medico")
     */
    public function medicoAction() {
        $em = $this->getDoctrine()->getManager();
        $esperandos = null;
        $especialidad = null;
        $hayConsultasActivas = null;
        $configuracion = $em->getRepository('AppBundle:Configuracion')->findAll();
        $profesional = $em->getRepository('AppBundle:Profesional')->findOneByPersona($this->getUser()->getPersona());
        //buscamos todos los servicios asociados al profesional 
        $servicioProfesional = $em->getRepository('AppBundle:ServicioProfesional')->findBy(array('profesional' => $profesional, 'status' => 'activo'));
        //Verificamos el Servicio Profesional que tiene activo en el día el Médico
        foreach ($servicioProfesional as &$valor) {
            if (($valor->getServicio()->getDia() == date("w"))) {
                $especialidad = $valor->getServicio()->getEspecialidad();
            }
        }

        if ($especialidad) {
            // $especialidad = $em->getRepository('AppBundle:Especialidad')->find($servicioProfesional->getServicio()->getEspecialidad());
            $esperandos = $this->numerosAction('activo', $especialidad); //Lista de pacientes en Espera
            $conCita = $this->numerosAction('cita', $especialidad, $profesional); //Lista de pacientes que van con el Dr.
            $atendidos = $this->numerosAction('atendido', $especialidad, $profesional); //Lista de pacientes atendidos
            $abandono = $this->numerosAction('abandono', $especialidad, $profesional); //Lista de pacientes que alcanzaron el limite de llamadas 
            //Buscamos Todas las Consultas Activas del Paciente en la especialidad del medico
            //dump($especialidad); die(); 
            if ('Enfermería' == $especialidad->getNombre()) {
                $hayConsultasActivas = $em->getRepository('AppBundle:Consulta')->findBy(array('egreso' => false, 'especialidad' => $especialidad));
            } else {
                $hayConsultasActivas = $em->getRepository('AppBundle:Consulta')->findBy(array('egreso' => false, 'profesional' => $profesional, 'especialidad' => $especialidad));
            }
            // dump($especialidad->getNombre()); die();

            switch ($especialidad->getNombre()) {
                case('Enfermería'): $enlace = 'homepage_enfermeria';
                    break;
                case('Odontología'): $enlace = 'homepage_odontologia';
                    break;
                default: $enlace = 'homepage_consulta';
            }

            // dump($enlace); die();
        } else {
            //Si no tiene una especialidad en el dia no puede ingresar al Modulo de Consulta
            return $this->render('default/index.html.twig', ['base_dir' => realpath($this->getParameter('kernel.root_dir') . '/..') . DIRECTORY_SEPARATOR,]);
        }

        return $this->render('default/medico.html.twig', array(
                    'esperandos' => $esperandos,
                    'especialidad' => $especialidad,
                    'abandono' => $abandono,
                    'atendidos' => $atendidos,
                    'conCita' => $conCita,
                    'penalizacion' => $configuracion[0]->getPenalizacion(),
                    'hayConsultasActivas' => $hayConsultasActivas,
                    'enlace' => $enlace,
        ));
    }

    /**
     * @Route("/sala", name="homepage_sala")
     */
    public function salaAction() {
        $em = $this->getDoctrine()->getManager();
        $configuracion = $em->getRepository('AppBundle:Configuracion')->findAll();
        $campania = new Campania();

        $campania = $configuracion[0]->getCampania();
        $campanium = $campania->getImagen()->getValues();
        asort($campanium);
//dump($campanium); die();


        return $this->render('sala/index.html.twig', array('campanium' => $campanium));
    }

    /**
     * Pagina Para Realizar Consultas Profesionales de Medicina General
     * 
     * @Route("/homepage_consulta/{paciente}", name = "homepage_consulta")
     */
    public function consultaAction($paciente) {
        $em = $this->getDoctrine()->getManager();
        $paciente = $em->getRepository('AppBundle:Paciente')->find($paciente);
        $evolucion = null;
        $afeccione = null;
        $reposo = null;
        $constancia = null;
        $receta = null;

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

        //Buscamos Todas las Citas Activas del Paciente
        $citas = $em->getRepository('AppBundle:Cita')->findBy(array('paciente' => $paciente, 'status' => 'activo',));
        //Buscamos Todas las Consultas Activas del Paciente en la especialidad del medico
        $tieneConsultaActiva = $em->getRepository('AppBundle:Consulta')->findOneBy(array('paciente' => $paciente, 'egreso' => false, 'profesional' => $profesional, 'especialidad' => $especialidad));

        if ($tieneConsultaActiva) {
            $consulta = $tieneConsultaActiva;
            //Buscar la Evolucion asociada a la Consulta
            $evolucion = $em->getRepository('AppBundle:Evolucion')->findOneBy(array('consulta' => $tieneConsultaActiva,));
            //Buscar las Afeccione asociada a la consulta
            $afeccione = $em->getRepository('AppBundle:Afeccione')->findOneBy(array('consulta' => $tieneConsultaActiva,));
            //Buscar Reposo asociada a la consulta
            $reposo = $em->getRepository('AppBundle:Reposo')->findOneBy(array('consulta' => $tieneConsultaActiva,));
            //dump($reposo);            die();
//Buscar Constancias asociada a la consulta
            $constancia = $em->getRepository('AppBundle:Constancia')->findOneBy(array('consulta' => $tieneConsultaActiva,));
            //Buscar Recetas asociada a la consulta
            $receta = $em->getRepository('AppBundle:Receta')->findOneBy(array('consulta' => $tieneConsultaActiva,));
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

        //Numeros asociados
        //Todas las consultas previas del paciente en la especialidad
        $historicoConsultas = $em->getRepository('AppBundle:Consulta')->findBy(array('paciente' => $paciente, 'egreso' => TRUE));
        //Todas las consultas previas del paciente en la especialidad y con el doctor
        $historicoConsultasMedico = $em->getRepository('AppBundle:Consulta')->findBy(array('paciente' => $paciente, 'profesional' => $profesional, 'egreso' => TRUE));
        //Todas los abandonos del paciente en la especialidad
        $historicoAbandono = $em->getRepository('AppBundle:Esperando')->findBy(array('paciente' => $paciente, 'especialidad' => $especialidad, 'status' => 'abandono'));
        //Todas las citas del paciente en la especialidad
        $historicoCita = $em->getRepository('AppBundle:Cita')->findBy(array('paciente' => $paciente, 'especialidad' => $especialidad, 'status' => 'activo'));
        //Tadas las Evoluciones del paciente
        $historicoEvolucion = $this->historicoEvolucion($paciente->getId(), $especialidad->getId());
        //Tadas las Afecciones del paciente
        $historicoAfecciones = $this->historicoAfecciones($paciente->getId(), $especialidad->getId());
        //Tadas los Reposos del paciente
        $historicoReposos = $this->historicoReposos($paciente->getId(), $especialidad->getId());
        //Tadas los Constancias del paciente
        $historicoConstancias = $this->historicoConstancias($paciente->getId(), $especialidad->getId());
        //Tadas las Recetas del paciente
        $historicoRecetas = $this->historicoRecetas($paciente->getId(), $especialidad->getId());


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
                    'citas' => $citas,
                    'historicoConsultas' => $historicoConsultas,
                    'historicoConsultasMedico' => $historicoConsultasMedico,
                    'historicoAbandono' => $historicoAbandono,
                    'historicoCita' => $historicoCita,
                    'historicoEvolucion' => $historicoEvolucion,
                    'historicoAfecciones' => $historicoAfecciones,
                    'reposo' => $reposo,
                    'historicoReposos' => $historicoReposos,
                    'constancia' => $constancia,
                    'historicoConstancias' => $historicoConstancias,
                    'receta' => $receta,
                    'historicoRecetas' => $historicoRecetas,
        ));
    }

    /**
     * Pagina Para Realizar Consultas Profesionales de Odontologia
     * 
     * @Route("/homepage_odontologia/{paciente}", name = "homepage_odontologia")
     */
    public function consultaOdontologiaAction($paciente) {

        $em = $this->getDoctrine()->getManager();
        $paciente = $em->getRepository('AppBundle:Paciente')->find($paciente);
        $odontograma = null;
        $reposo = null;
        $constancia = null;
        $receta = null;

        // Buscamos si el Paciente tiene Historia Medica Odontologica
        // $historicoAntecedentes = $em->getRepository('AppBundle:Antecedente')->findByPaciente($paciente);
        $historicoAntecedentes = null;


        $profesional = $em->getRepository('AppBundle:Profesional')->findOneByPersona($this->getUser()->getPersona());
        $ServicioProfesional = $em->getRepository('AppBundle:ServicioProfesional')->findByProfesional($profesional);
        foreach ($ServicioProfesional as &$valor) {
            if ($valor->getServicio()->getDia() == date("w") && $valor->getStatus() == 'activo') {
                $especialidad = $valor->getServicio()->getEspecialidad();
            }
        }


        //Buscamos Todas las Citas Activas del Paciente
        $citas = $em->getRepository('AppBundle:Cita')->findBy(array('paciente' => $paciente, 'status' => 'activo',));

        //Buscamos Todos los Tratamientos
        $tratamientos = $em->getRepository('AppBundle:Tratamiento')->findAll();
        // dump($tratamientos); die(); 
        //Buscamos Todas las Consultas Activas del Paciente en la especialidad del medico
        $tieneConsultaActiva = $em->getRepository('AppBundle:Consulta')->findOneBy(array('paciente' => $paciente, 'egreso' => false, 'profesional' => $profesional, 'especialidad' => $especialidad));

        if ($tieneConsultaActiva) {
            $consulta = $tieneConsultaActiva;
            //Buscar los Odontogramas asociado a la Consulta
            $odontograma = $em->getRepository('AppBundle:Odontograma')->findBy(array('consulta' => $consulta,));
            //Buscar Reposo asociada a la consulta
            $reposo = $em->getRepository('AppBundle:Reposo')->findOneBy(array('consulta' => $consulta,));
            //Buscar Constancias asociada a la consulta
            $constancia = $em->getRepository('AppBundle:Constancia')->findOneBy(array('consulta' => $consulta,));
            //Buscar Recetas asociada a la consulta
            $receta = $em->getRepository('AppBundle:Receta')->findOneBy(array('consulta' => $consulta,));
        } else {
            //Creamos una nueva consulta
            if (in_array('ROLE_MEDICO', $this->getUser()->getRoles()) && $especialidad) {
                $consulta = new Consulta();
                $consulta->setFecha(new \DateTime('now'));
                $consulta->setEgreso(FALSE);
                $consulta->setPaciente($paciente);
                $consulta->setProfesional($profesional);
                $consulta->setEspecialidad($especialidad);
                $em->persist($consulta);
                $em->flush($consulta);
            }
        }

        //Numeros asociados
        //Todas las consultas previas del paciente en la especialidad
        $historicoConsultas = $em->getRepository('AppBundle:Consulta')->findBy(array('especialidad' => $especialidad, 'paciente' => $paciente, 'egreso' => TRUE));
        //Historia odontologica del Paciente
        $historicoOdontologica = $em->getRepository('AppBundle:HistoriaOdontologica')->findOneBy(array('paciente' => $paciente));

        //Todas las consultas previas del paciente en la especialidad y con el doctor
        $historicoConsultasMedico = $em->getRepository('AppBundle:Consulta')->findBy(array('paciente' => $paciente, 'profesional' => $profesional, 'egreso' => TRUE));
        //Todas los abandonos del paciente en la especialidad
        $historicoAbandono = $em->getRepository('AppBundle:Esperando')->findBy(array('paciente' => $paciente, 'especialidad' => $especialidad, 'status' => 'abandono'));
        //Todas las citas del paciente en la especialidad
        $historicoCita = $em->getRepository('AppBundle:Cita')->findBy(array('paciente' => $paciente, 'especialidad' => $especialidad, 'status' => 'activo'));
        //Tadas las Odontograma del paciente
        $historicoOdontograma = $this->historicoOdontograma($paciente->getId(), $especialidad->getId());
        //Odontogramas por Consulta
        $odontogramasPorConsultas= $this->odontogramaConsulta($paciente->getId());
        
        //dump($historicoOdontograma,$odontogramasPorConsultas ); die(); 
        
        //Tadas los Reposos del paciente
        $historicoReposos = $this->historicoReposos($paciente->getId(), $especialidad->getId());
        //Tadas los Constancias del paciente
        $historicoConstancias = $this->historicoConstancias($paciente->getId(), $especialidad->getId());
        //Tadas las Recetas del paciente
        $historicoRecetas = $this->historicoRecetas($paciente->getId(), $especialidad->getId());

        // dump ($consulta,$odontograma,$reposo,$constancia,$receta ); die("odontologia");
        return $this->render('default/odontologia.html.twig', array(
                    'paciente' => $paciente,
                    'historicoAntecedentes' => $historicoAntecedentes,
                    'odontograma' => $odontograma,
                    'historicoOdontograma' => $historicoOdontograma,
                    'odontogramasPorConsultas' => $odontogramasPorConsultas,
                    'citas' => $citas,
                    'historicoCita' => $historicoCita,
                    'consulta' => $consulta,
                    'historicoConsultas' => $historicoConsultas,
                    'historicoConsultasMedico' => $historicoConsultasMedico,
                    'historicoAbandono' => $historicoAbandono,
                    'reposo' => $reposo,
                    'historicoReposos' => $historicoReposos,
                    'constancia' => $constancia,
                    'historicoConstancias' => $historicoConstancias,
                    'receta' => $receta,
                    'historicoRecetas' => $historicoRecetas,
                    'tratamientos' => $tratamientos,
                    'historicoOdontologica' => $historicoOdontologica,
        ));
    }

    /**
     * Pagina Para Realizar Consultas Profesionales de Enfermeria
     * 
     * @Route("/homepage_enfermeria/{paciente}", name = "homepage_enfermeria")
     */
    public function enfermeriaAction($paciente) {

        $em = $this->getDoctrine()->getManager();
        $datosVitales = null;
        $medicamentoSuministrado = null;
        $paciente = $em->getRepository('AppBundle:Paciente')->find($paciente);
        $profesional = $em->getRepository('AppBundle:Profesional')->findOneByPersona($this->getUser()->getPersona());
        $ServicioProfesional = $em->getRepository('AppBundle:ServicioProfesional')->findByProfesional($profesional);
        foreach ($ServicioProfesional as &$valor) {
            if ($valor->getServicio()->getDia() == date("w") && $valor->getStatus() == 'activo') {
                $especialidad = $valor->getServicio()->getEspecialidad();
            }
        }

        //Buscamos Todas las Citas Activas del Paciente
        $citas = $em->getRepository('AppBundle:Cita')->findBy(array('paciente' => $paciente, 'status' => 'activo',));

        //Buscamos Todas las Consultas Activas del Paciente en la especialidad del medico
        $tieneConsultaActiva = $em->getRepository('AppBundle:Consulta')->findOneBy(array('paciente' => $paciente, 'egreso' => false, 'especialidad' => $especialidad));

        if ($tieneConsultaActiva) {
            $consulta = $tieneConsultaActiva;
            //Buscar  Signos Vitales asociada a la Consulta
            $datosVitales = $em->getRepository('AppBundle:SignosVitalesSuministrados')->findBy(array('consulta' => $tieneConsultaActiva,));
            //Buscar los medicamentos suministrados asociada a la Consulta
            $medicamentoSuministrado = $em->getRepository('AppBundle:MedicamentoSuministrado')->findBy(array('consulta' => $consulta,));
            //Buscar los insumos suministrados asociada a la Consulta
            $insumoSuministrado = $em->getRepository('AppBundle:InsumoSuministrado')->findBy(array('consulta' => $consulta,));
            //Buscar las Observaciones asociada a la Consulta
            $observaciones = $em->getRepository('AppBundle:Observacion')->findBy(array('consulta' => $consulta,));
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

        //Numeros asociados
        //Todas las consultas previas del paciente en la especialidad
        $historicoConsultas = $em->getRepository('AppBundle:Consulta')->findBy(array('paciente' => $paciente, 'especialidad' => $especialidad, 'egreso' => TRUE));
        //Todas las consultas previas del paciente en la especialidad y con el doctor
        $historicoConsultasMedico = $em->getRepository('AppBundle:Consulta')->findBy(array('paciente' => $paciente, 'profesional' => $profesional, 'egreso' => TRUE));
        //Todas los abandonos del paciente en la especialidad
        $historicoAbandono = $em->getRepository('AppBundle:Esperando')->findBy(array('paciente' => $paciente, 'especialidad' => $especialidad, 'status' => 'abandono'));
        //Todas las citas del paciente en la especialidad
        $historicoCita = $em->getRepository('AppBundle:Cita')->findBy(array('paciente' => $paciente, 'especialidad' => $especialidad, 'status' => 'activo'));

        return $this->render('default/enfermeria.html.twig', array(
                    'paciente' => $paciente,
                    'consulta' => $consulta,
                    'citas' => $citas,
                    'datosVitales' => $datosVitales,
                    'historicoConsultas' => $historicoConsultas,
                    'historicoConsultasMedico' => $historicoConsultasMedico,
                    'historicoAbandono' => $historicoAbandono,
                    'historicoCita' => $historicoCita,
                    'medicamentos' => $medicamentoSuministrado,
                    'insumos' => $insumoSuministrado,
                    'observaciones' => $observaciones,
        ));
    }

    private function numerosAction($status, $especialidad, $profesional = null) {
        $hoy = new \DateTime('now');
        $hoy->setTime(0, 0, 0);
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('AppBundle:Esperando');

        if (!$profesional) {
            $query = $repository->createQueryBuilder('p')
                    ->where('p.fechaRegistro >= :hoy')
                    ->andWhere('p.especialidad = :especialidad')
                    ->andWhere('p.status = :status')
                    ->setParameter('hoy', $hoy)
                    ->setParameter('especialidad', $especialidad)
                    ->setParameter('status', $status)
                    ->orderBy('p.posicion', 'ASC')
                    ->getQuery();
        } else {
            if ($status != 'cita') {
                $query = $repository->createQueryBuilder('p')
                        ->where('p.fechaRegistro >= :hoy')
                        ->andWhere('p.especialidad = :especialidad')
                        ->andWhere('p.medico = :profesional')
                        ->andWhere('p.status = :status')
                        ->setParameter('hoy', $hoy)
                        ->setParameter('especialidad', $especialidad)
                        ->setParameter('profesional', $profesional)
                        ->setParameter('status', $status)
                        ->orderBy('p.posicion', 'ASC')
                        ->getQuery();
            } else {

                $query = $repository->createQueryBuilder('p')
                        ->where('p.fechaRegistro >= :hoy')
                        ->andWhere('p.especialidad = :especialidad')
                        ->andWhere('p.profesional = :profesional')
                        ->andWhere('p.status = :status')
                        ->setParameter('hoy', $hoy)
                        ->setParameter('especialidad', $especialidad)
                        ->setParameter('profesional', $profesional)
                        ->setParameter('status', 'activo')
                        ->orderBy('p.posicion', 'ASC')
                        ->getQuery();
            }
        }

        return $query->getResult();
    }

    //Buscamos todas las Evoluciones del Pacientes en las diferentes consultas de la especialidad
    private function historicoEvolucion($paciente, $especialidad) {
        $conn = $this->getDoctrine()->getManager()->getConnection();
        $sql = 'select e.objetivo, e.subjetivo,e.apreciacion, e.tratamiento, e.frecuencia,e.edad, c.fecha, per.primer_apellido, per.primer_nombre '
                . 'from evolucion as e '
                . 'left join consulta as c on e.consulta_id=c.id '
                . 'left join profesional as p on  p.id=c.profesional_id '
                . 'left join persona as per on p.persona_id=per.id '
                . 'where c.paciente_id=:paciente and c.especialidad_id=:especialidad and c.egreso=true ';
        $stmt = $conn->prepare($sql);
        $stmt->execute(array('especialidad' => $especialidad, 'paciente' => $paciente));
        return $stmt->fetchAll();
    }

    //Buscamos todas los odontogramas del Pacientes en las diferentes consultas de la especialidad
    private function historicoOdontograma($paciente, $especialidad) {
        $conn = $this->getDoctrine()->getManager()->getConnection();
        $sql = 'select e.id, d.posicion, d.nombre, t1.nombre as cavidad1, t2.nombre as cavidad2, t3.nombre as cavidad3, t4.nombre as cavidad4, t5.nombre as cavidad5,  c.fecha, per.primer_apellido, per.primer_nombre '
                . 'from odontograma as e '
                . 'left join diente as d on e.diente_id=d.id '
                . 'left join tratamiento as t1 on e.cavidad_1=t1.id '
                . 'left join tratamiento as t2 on e.cavidad_2=t2.id '
                . 'left join tratamiento as t3 on e.cavidad_3=t3.id '
                . 'left join tratamiento as t4 on e.cavidad_4=t4.id '
                . 'left join tratamiento as t5 on e.cavidad_5=t5.id '
                . 'left join consulta as c on e.consulta_id=c.id '
                . 'left join profesional as p on  p.id=c.profesional_id '
                . 'left join persona as per on p.persona_id=per.id '
                . 'where c.paciente_id=:paciente and c.especialidad_id=:especialidad and c.egreso=true '
                . 'order by d.posicion';
        $stmt = $conn->prepare($sql);
        $stmt->execute(array('especialidad' => $especialidad, 'paciente' => $paciente));
        return $stmt->fetchAll();
    }

    //Buscamos todas las Afecciones del Pacientes en las diferentes consultas de la especialidad
    private function historicoAfecciones($paciente, $especialidad) {
        $conn = $this->getDoctrine()->getManager()->getConnection();
        $sql = 'select a.diagnostico as diagnostico, a.tratamiento, ec.nombre as capitulo, eg.nombre as grupo, ee.codigo as codigo, ee.nombre as elemento, c.fecha, per.primer_apellido, per.primer_nombre 
            from afeccione as a 
            left join consulta as c on a.consulta_id=c.id
            left join profesional as p on  p.id=c.profesional_id
            left join persona as per on p.persona_id=per.id
            left join enterica_elemento as ee on ee.id=a.enterica_elemento_id
            left join enterica_grupo as eg on eg.id=ee.entericagrupo_id
            left join enterica_capitulo as ec on ec.id=eg.entericacapitulo_id
            where c.paciente_id=:paciente and c.especialidad_id=:especialidad and c.egreso=true';
        $stmt = $conn->prepare($sql);
        $stmt->execute(array('especialidad' => $especialidad, 'paciente' => $paciente));
        return $stmt->fetchAll();
    }

    //Buscamos todas los Reposos del Pacientes en las diferentes consultas de la especialidad
    private function historicoReposos($paciente, $especialidad) {
        $conn = $this->getDoctrine()->getManager()->getConnection();
        $sql = 'select r.observacion,r.inicio, c.fecha, per.primer_apellido, per.primer_nombre 
            from reposo as r 
            left join consulta as c on r.consulta_id= c.id
            left join profesional as p on c.profesional_id=p.id
            left join persona as per on p.persona_id=per.id
            where c.paciente_id=:paciente and c.especialidad_id=:especialidad and c.egreso=true';
        $stmt = $conn->prepare($sql);
        $stmt->execute(array('especialidad' => $especialidad, 'paciente' => $paciente));
        return $stmt->fetchAll();
    }

    //Buscamos todas los Reposos del Pacientes en las diferentes consultas de la especialidad
    private function historicoConstancias($paciente, $especialidad) {
        $conn = $this->getDoctrine()->getManager()->getConnection();
        $sql = 'select r.observacion,c.fecha, per.primer_apellido, per.primer_nombre 
            from constancia as r 
            left join consulta as c on r.consulta_id= c.id
            left join profesional as p on c.profesional_id=p.id
            left join persona as per on p.persona_id=per.id
            where c.paciente_id=:paciente and c.especialidad_id=:especialidad and c.egreso=true';
        $stmt = $conn->prepare($sql);
        $stmt->execute(array('especialidad' => $especialidad, 'paciente' => $paciente));
        return $stmt->fetchAll();
    }

    //Buscamos todas las Recetas del Pacientes en las diferentes consultas de la especialidad
    private function historicoRecetas($paciente, $especialidad) {
        $conn = $this->getDoctrine()->getManager()->getConnection();
        $sql = 'select r.observacion,c.fecha, per.primer_apellido, per.primer_nombre 
            from receta as r 
            left join consulta as c on r.consulta_id= c.id
            left join profesional as p on c.profesional_id=p.id
            left join persona as per on p.persona_id=per.id
            where c.paciente_id=:paciente and c.especialidad_id=:especialidad and c.egreso=true';
        $stmt = $conn->prepare($sql);
        $stmt->execute(array('especialidad' => $especialidad, 'paciente' => $paciente));
        return $stmt->fetchAll();
    }

    private function odontogramaConsulta($paciente) {

        $conn = $this->getDoctrine()->getManager()->getConnection();
        $sql = '
            select c.id as id, c.fecha as consulta, COUNT(c.id) as dientes_tratados
            from odontograma as o
            left join consulta as c on c.id=o.consulta_id
            left join diente as d on d.id=o.diente_id
            left join paciente as pac on pac.id=c.paciente_id
            left join profesional as prof on prof.id=c.profesional_id
            left join persona as pers on pers.id=prof.persona_id
            where pac.id=:paciente and c.egreso=:egreso
            GROUP BY c.id
            order by c.id desc
            ';
        $stmt = $conn->prepare($sql);
        $stmt->execute(array('paciente' => $paciente,'egreso'=>true));
        return $stmt->fetchAll();
    }

}

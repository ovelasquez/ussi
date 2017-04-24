<?php

namespace AppBundle\EventListener;

use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use \FOS\UserBundle\Model\UserManagerInterface;
use Doctrine\ORM\EntityManager;
use AppBundle\Entity\Profesional;
use AppBundle\Entity\Paciente;

class RegistrationListener implements EventSubscriberInterface {

    private $userManager;
    protected $em;

    public function __construct(UserManagerInterface $userManager, EntityManager $em) {
        $this->userManager = $userManager;
        $this->em = $em;
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents() {
        return array(
            FOSUserEvents::REGISTRATION_COMPLETED => 'onRegistrationCompleted',
        );
    }

    public function onRegistrationCompleted(FilterUserResponseEvent $event) {

        $user = $event->getUser();
        $user->setRoles(array("ROLE_MEDICO"));
        $this->userManager->updateUser($user);

        $form = $event->getRequest()->request->get('fos_user_registration_form');
        $formProfesional = $form['profesional'];



        $profesional = new Profesional();
        $profesional->setPersona($user->getPersona());

        $profesional->setCodigoSsa($formProfesional['codigoSsa']);
        $persona = $this->em->getRepository('AppBundle:Persona')->find($profesional->getPersona()->getId());
        $persona->setFechaRegistro(new \DateTime("now"));

        if ($profesional->getPersona()->getFoto() == null) {
            $persona->setFoto('user.png');
        }
        $this->em->persist($persona);
        $this->em->flush($persona);

        $profesional->getPersona()->setFechaRegistro(new \DateTime("now"));
        $this->em->persist($profesional);
        $this->em->flush($profesional);

        $paciente = new Paciente();
        $paciente->setPersona($user->getPersona());
        $paciente->setAnalfabeta(FALSE);
        $paciente->setAnoAprobado('5');
        $paciente->setApellidoFamilia($user->getPersona()->getPrimerApellido());
        $paciente->setCedulaJefeFamilia($user->getPersona()->getCedula());
        $paciente->setComunidad('administrativo');
        $paciente->setEdoCivil($formProfesional['edoCivil']);
        $paciente->setEstudio('universitaria');
        if (!empty($formProfesional['etnia'])) {
            $etnia = $this->em->getRepository('AppBundle:Etnia')->find($formProfesional['etnia']);
            $paciente->setEtnia($etnia);
        } else {
            $paciente->setEtnia(null);
        }
        if (!empty($formProfesional['religion'])) {
            $religion = $this->em->getRepository('AppBundle:Religion')->find($formProfesional['religion']);
            $paciente->setReligion($religion);
        } else {
            $paciente->setReligion(null);
        }

        $fechaNacimiento = $formProfesional['fechaNacimiento'];
        $paciente->setFechaNacimiento(new \DateTime($fechaNacimiento['year'] . "-" . $fechaNacimiento['month'] . "-" . $fechaNacimiento['day']));


        $paciente->setOcupacion('Profesional');
        $paciente->setFechaRegistro(new \DateTime("now"));

        $this->em->persist($paciente);
        $this->em->flush($paciente);
        
        $event->stopPropagation();
    }

}

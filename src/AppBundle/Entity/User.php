<?php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    public function __construct() {
        
        parent::__construct();
    }

    /**
     * @var \Persona
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Persona", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="persona_id", referencedColumnName="id")
     * })
     */
    protected $persona;


    /**
     * Set persona
     *
     * @param \AppBundle\Entity\Persona $persona
     *
     * @return User
     */
    public function setPersona(\AppBundle\Entity\Persona $persona = null)
    {
        $this->persona = $persona;

        return $this;
    }

    /**
     * Get persona
     *
     * @return \AppBundle\Entity\Persona
     */
    public function getPersona()
    {
        return $this->persona;
    }
    
    public function __toString() {
        return $this->getPersona()->getPrimerNombre().' '.$this->getPersona()->getPrimerApellido();
    }
}

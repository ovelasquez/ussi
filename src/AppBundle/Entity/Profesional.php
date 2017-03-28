<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Profesional
 *
 * @ORM\Table(name="profesional", indexes={@ORM\Index(name="IDX_2BB32E08F5F88DB9", columns={"persona_id"})})
 * @ORM\Entity
 */
class Profesional {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="profesional_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo_ssa", type="string", length=255, nullable=true)
     */
    private $codigoSsa;

    /**
     * @var \Persona
     *
     * @ORM\ManyToOne(targetEntity="Persona",cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="persona_id", referencedColumnName="id")
     * })
     */
    private $persona;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set codigoSsa
     *
     * @param string $codigoSsa
     *
     * @return Profesional
     */
    public function setCodigoSsa($codigoSsa) {
        $this->codigoSsa = $codigoSsa;

        return $this;
    }

    /**
     * Get codigoSsa
     *
     * @return string
     */
    public function getCodigoSsa() {
        return $this->codigoSsa;
    }

    /**
     * Set persona
     *
     * @param \AppBundle\Entity\Persona $persona
     *
     * @return Profesional
     */
    public function setPersona(\AppBundle\Entity\Persona $persona = null) {
        $this->persona = $persona;

        return $this;
    }

    /**
     * Get persona
     *
     * @return \AppBundle\Entity\Persona
     */
    public function getPersona() {
        return $this->persona;
    }

    public function __toString() {
        try {
            return (string) $this->getPersona()->getCedula(). ' ' .(string) $this->getPersona()->getPrimerNombre(). ' ' .(string) $this->getPersona()->getPrimerApellido();
        } catch (Exception $e) {
            return get_class($this) . '@' . spl_object_hash($this); 
        }
    }

}

<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProfesionalEspecialidad
 *
 * @ORM\Table(name="profesional_especialidad", indexes={@ORM\Index(name="IDX_2C3C3D7E16A490EC", columns={"especialidad_id"}), @ORM\Index(name="IDX_2C3C3D7E313D7FB9", columns={"profesional_id"})})
 * @ORM\Entity
 */
class ProfesionalEspecialidad
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="profesional_especialidad_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \Especialidad
     *
     * @ORM\ManyToOne(targetEntity="Especialidad")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="especialidad_id", referencedColumnName="id")
     * })
     */
    private $especialidad;

    /**
     * @var \Profesional
     *
     * @ORM\ManyToOne(targetEntity="Profesional")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="profesional_id", referencedColumnName="id")
     * })
     */
    private $profesional;



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set especialidad
     *
     * @param \AppBundle\Entity\Especialidad $especialidad
     *
     * @return ProfesionalEspecialidad
     */
    public function setEspecialidad(\AppBundle\Entity\Especialidad $especialidad = null)
    {
        $this->especialidad = $especialidad;

        return $this;
    }

    /**
     * Get especialidad
     *
     * @return \AppBundle\Entity\Especialidad
     */
    public function getEspecialidad()
    {
        return $this->especialidad;
    }

    /**
     * Set profesional
     *
     * @param \AppBundle\Entity\Profesional $profesional
     *
     * @return ProfesionalEspecialidad
     */
    public function setProfesional(\AppBundle\Entity\Profesional $profesional = null)
    {
        $this->profesional = $profesional;

        return $this;
    }

    /**
     * Get profesional
     *
     * @return \AppBundle\Entity\Profesional
     */
    public function getProfesional()
    {
        return $this->profesional;
    }
    
    public function __toString() {
        try {
            return (string) $this-> getProfesional()->getPersona()->getCedula().' - '.$this->getEspecialidad()->getNombre();
        } catch (Exception $e) {
            return get_class($this) . '@' . spl_object_hash($this); 
        }
    }
    
}

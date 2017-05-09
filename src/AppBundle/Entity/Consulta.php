<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Consulta
 *
 * @ORM\Table(name="consulta")
 * @ORM\Entity
 */
class Consulta
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
       
      /**
     * @var \Paciente
     *
     * @ORM\ManyToOne(targetEntity="Paciente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="paciente_id", referencedColumnName="id")
     * })
     */
    private $paciente;
    
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
     * @var \Especialidad
     *
     * @ORM\ManyToOne(targetEntity="Especialidad")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="especialidad_id", referencedColumnName="id")
     * })
     */
    private $especialidad;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="egreso", type="boolean", nullable=true)
     */
    private $egreso = false;
    
       /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime", nullable=false)
     */
    private $fecha;



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
     * Set egreso
     *
     * @param boolean $egreso
     *
     * @return Consulta
     */
    public function setEgreso($egreso)
    {
        $this->egreso = $egreso;

        return $this;
    }

    /**
     * Get egreso
     *
     * @return boolean
     */
    public function getEgreso()
    {
        return $this->egreso;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return Consulta
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set paciente
     *
     * @param \AppBundle\Entity\Paciente $paciente
     *
     * @return Consulta
     */
    public function setPaciente(\AppBundle\Entity\Paciente $paciente = null)
    {
        $this->paciente = $paciente;

        return $this;
    }

    /**
     * Get paciente
     *
     * @return \AppBundle\Entity\Paciente
     */
    public function getPaciente()
    {
        return $this->paciente;
    }

    /**
     * Set profesional
     *
     * @param \AppBundle\Entity\Profesional $profesional
     *
     * @return Consulta
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

    /**
     * Set especialidad
     *
     * @param \AppBundle\Entity\Especialidad $especialidad
     *
     * @return Consulta
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
    
    public function __toString() {
        return $this->getPaciente()->getPersona()->getPrimerNombre()
                .' '.$this->getPaciente()->getPersona()->getPrimerApellido()
                .' - Especialidad: '.$this->getEspecialidad()->getNombre()
                ;
    }
}

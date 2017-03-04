<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Disponible
 *
 * @ORM\Table(name="disponible", indexes={@ORM\Index(name="IDX_23BCDFC37DA9B47F", columns={"profesional_especialidad_id"})})
 * @ORM\Entity
 */
class Disponible
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="disponible_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime", nullable=false)
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="consultorio", type="string", length=255, nullable=false)
     */
    private $consultorio;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=255, nullable=false)
     */
    private $status;

    /**
     * @var \ProfesionalEspecialidad
     *
     * @ORM\ManyToOne(targetEntity="ProfesionalEspecialidad")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="profesional_especialidad_id", referencedColumnName="id")
     * })
     */
    private $profesionalEspecialidad;



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
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return Disponible
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
     * Set consultorio
     *
     * @param string $consultorio
     *
     * @return Disponible
     */
    public function setConsultorio($consultorio)
    {
        $this->consultorio = $consultorio;

        return $this;
    }

    /**
     * Get consultorio
     *
     * @return string
     */
    public function getConsultorio()
    {
        return $this->consultorio;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return Disponible
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set profesionalEspecialidad
     *
     * @param \AppBundle\Entity\ProfesionalEspecialidad $profesionalEspecialidad
     *
     * @return Disponible
     */
    public function setProfesionalEspecialidad(\AppBundle\Entity\ProfesionalEspecialidad $profesionalEspecialidad = null)
    {
        $this->profesionalEspecialidad = $profesionalEspecialidad;

        return $this;
    }

    /**
     * Get profesionalEspecialidad
     *
     * @return \AppBundle\Entity\ProfesionalEspecialidad
     */
    public function getProfesionalEspecialidad()
    {
        return $this->profesionalEspecialidad;
    }
}

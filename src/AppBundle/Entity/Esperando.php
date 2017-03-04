<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Esperando
 *
 * @ORM\Table(name="esperando", indexes={@ORM\Index(name="IDX_F82E1F7DACB064F9", columns={"especialidad"}), @ORM\Index(name="IDX_F82E1F7D2BB32E08", columns={"profesional"}), @ORM\Index(name="IDX_F82E1F7D7310DAD4", columns={"paciente_id"})})
 * @ORM\Entity
 */
class Esperando
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="esperando_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_registro", type="datetime", nullable=false)
     */
    private $fechaRegistro;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=255, nullable=false)
     */
    private $status;

    /**
     * @var \Especialidad
     *
     * @ORM\ManyToOne(targetEntity="Especialidad")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="especialidad", referencedColumnName="id")
     * })
     */
    private $especialidad;

    /**
     * @var \Profesional
     *
     * @ORM\ManyToOne(targetEntity="Profesional")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="profesional", referencedColumnName="id")
     * })
     */
    private $profesional;

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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set fechaRegistro
     *
     * @param \DateTime $fechaRegistro
     *
     * @return Esperando
     */
    public function setFechaRegistro($fechaRegistro)
    {
        $this->fechaRegistro = $fechaRegistro;

        return $this;
    }

    /**
     * Get fechaRegistro
     *
     * @return \DateTime
     */
    public function getFechaRegistro()
    {
        return $this->fechaRegistro;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return Esperando
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
     * Set especialidad
     *
     * @param \AppBundle\Entity\Especialidad $especialidad
     *
     * @return Esperando
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
     * @return Esperando
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
     * Set paciente
     *
     * @param \AppBundle\Entity\Paciente $paciente
     *
     * @return Esperando
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
}

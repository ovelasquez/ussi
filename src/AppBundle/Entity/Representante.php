<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Representante
 *
 * @ORM\Table(name="representante", indexes={@ORM\Index(name="idx_de2d5957310dad4", columns={"paciente_id"})})
 * @ORM\Entity
 */
class Representante
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="representante_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nacionalidad", type="string", length=1, nullable=false)
     */
    private $nacionalidad;

    /**
     * @var string
     *
     * @ORM\Column(name="cedula", type="string", length=255, nullable=false)
     */
    private $cedula;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_apellido", type="string", length=255, nullable=false)
     */
    private $nombreApellido;

    /**
     * @var string
     *
     * @ORM\Column(name="parentesco", type="string", length=255, nullable=false)
     */
    private $parentesco;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono", type="string", length=255, nullable=false)
     */
    private $telefono;

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
     * Set nacionalidad
     *
     * @param string $nacionalidad
     *
     * @return Representante
     */
    public function setNacionalidad($nacionalidad)
    {
        $this->nacionalidad = $nacionalidad;

        return $this;
    }

    /**
     * Get nacionalidad
     *
     * @return string
     */
    public function getNacionalidad()
    {
        return $this->nacionalidad;
    }

    /**
     * Set cedula
     *
     * @param string $cedula
     *
     * @return Representante
     */
    public function setCedula($cedula)
    {
        $this->cedula = $cedula;

        return $this;
    }

    /**
     * Get cedula
     *
     * @return string
     */
    public function getCedula()
    {
        return $this->cedula;
    }

    /**
     * Set nombreApellido
     *
     * @param string $nombreApellido
     *
     * @return Representante
     */
    public function setNombreApellido($nombreApellido)
    {
        $this->nombreApellido = $nombreApellido;

        return $this;
    }

    /**
     * Get nombreApellido
     *
     * @return string
     */
    public function getNombreApellido()
    {
        return $this->nombreApellido;
    }

    /**
     * Set parentesco
     *
     * @param string $parentesco
     *
     * @return Representante
     */
    public function setParentesco($parentesco)
    {
        $this->parentesco = $parentesco;

        return $this;
    }

    /**
     * Get parentesco
     *
     * @return string
     */
    public function getParentesco()
    {
        return $this->parentesco;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     *
     * @return Representante
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return string
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set paciente
     *
     * @param \AppBundle\Entity\Paciente $paciente
     *
     * @return Representante
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

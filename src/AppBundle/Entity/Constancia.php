<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Constancia
 *
 * @ORM\Table(name="constancia")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ConstanciaRepository")
 */
class Constancia
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

  /**
     * @var \Consulta
     *
     * @ORM\ManyToOne(targetEntity="Consulta")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="consulta_id", referencedColumnName="id")
     * })
     */
    private $consulta;

    /**
     * @var string
     *
     * @ORM\Column(name="observacion", type="text")
     */
    private $observacion;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo", type="string", length=255, unique=true)
     */
    private $codigo;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    
    /**
     * Set consulta
     *
     * @param \AppBundle\Entity\Consulta $consulta
     *
     * @return Reposo
     */
    public function setConsulta(\AppBundle\Entity\Consulta $consulta = null)
    {
        $this->consulta = $consulta;

        return $this;
    }

    /**
     * Get consulta
     *
     * @return \AppBundle\Entity\Consulta
     */
    public function getConsulta()
    {
        return $this->consulta;
    }

    /**
     * Set observacion
     *
     * @param string $observacion
     *
     * @return Constancia
     */
    public function setObservacion($observacion)
    {
        $this->observacion = $observacion;

        return $this;
    }

    /**
     * Get observacion
     *
     * @return string
     */
    public function getObservacion()
    {
        return $this->observacion;
    }

    /**
     * Set codigo
     *
     * @param string $codigo
     *
     * @return Constancia
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * Get codigo
     *
     * @return string
     */
    public function getCodigo()
    {
        return $this->codigo;
    }
}


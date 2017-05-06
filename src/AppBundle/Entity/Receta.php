<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Receta
 *
 * @ORM\Table(name="receta")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RecetaRepository")
 */
class Receta
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
     * @return Receta
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
}


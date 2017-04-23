<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Evolucion
 *
 * @ORM\Table(name="evolucion")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EvolucionRepository")
 */
class Evolucion {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="objetivo", type="text")
     */
    private $objetivo;

    /**
     * @var string
     *
     * @ORM\Column(name="subjetivo", type="text")
     */
    private $subjetivo;

    /**
     * @var string
     *
     * @ORM\Column(name="apreciacion", type="text")
     */
    private $apreciacion;

    /**
     * @var string
     *
     * @ORM\Column(name="tratamiento", type="text")
     */
    private $tratamiento;

    /**
     * @var string
     *
     * @ORM\Column(name="frecuencia", type="string", length=255, nullable=true)
     */
    private $frecuencia;

    /**
     * @var integer
     *
     * @ORM\Column(name="edad", type="integer", nullable=true)
     */
    private $edad = '0';

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
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set objetivo
     *
     * @param string $objetivo
     *
     * @return Evolucion
     */
    public function setObjetivo($objetivo) {
        $this->objetivo = $objetivo;

        return $this;
    }

    /**
     * Get objetivo
     *
     * @return string
     */
    public function getObjetivo() {
        return $this->objetivo;
    }

    /**
     * Set subjetivo
     *
     * @param string $subjetivo
     *
     * @return Evolucion
     */
    public function setSubjetivo($subjetivo) {
        $this->subjetivo = $subjetivo;

        return $this;
    }

    /**
     * Get subjetivo
     *
     * @return string
     */
    public function getSubjetivo() {
        return $this->subjetivo;
    }

    /**
     * Set apreciacion
     *
     * @param string $apreciacion
     *
     * @return Evolucion
     */
    public function setApreciacion($apreciacion) {
        $this->apreciacion = $apreciacion;

        return $this;
    }

    /**
     * Get apreciacion
     *
     * @return string
     */
    public function getApreciacion() {
        return $this->apreciacion;
    }

    /**
     * Set tratamiento
     *
     * @param string $tratamiento
     *
     * @return Evolucion
     */
    public function setTratamiento($tratamiento) {
        $this->tratamiento = $tratamiento;

        return $this;
    }

    /**
     * Get tratamiento
     *
     * @return string
     */
    public function getTratamiento() {
        return $this->tratamiento;
    }

    /**
     * Set frecuencia
     *
     * @param string $frecuencia
     *
     * @return Evolucion
     */
    public function setFrecuencia($frecuencia) {
        $this->frecuencia = $frecuencia;

        return $this;
    }

    /**
     * Get frecuencia
     *
     * @return string
     */
    public function getFrecuencia() {
        return $this->frecuencia;
    }

    /**
     * Set consulta
     *
     * @param \AppBundle\Entity\Consulta $consulta
     *
     * @return Evolucion
     */
    public function setConsulta(\AppBundle\Entity\Consulta $consulta = null) {
        $this->consulta = $consulta;

        return $this;
    }

    /**
     * Get consulta
     *
     * @return \AppBundle\Entity\Consulta
     */
    public function getConsulta() {
        return $this->consulta;
    }

    /**
     * Set edad
     *
     * @param integer $edad
     *
     * @return Evolucion
     */
    public function setEdad($edad) {
        $this->edad = $edad;

        return $this;
    }

    /**
     * Get edad
     *
     * @return integer
     */
    public function getEdad() {
        return $this->edad;
    }

}

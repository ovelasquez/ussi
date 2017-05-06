<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Servicio
 *
 * @ORM\Table(name="servicio")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ServicioRepository")
 */
class Servicio {

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
     * @ORM\Column(name="turno", type="string", length=255)
     */
    private $turno;

    /**
     * @var string
     *
     * @ORM\Column(name="procedencia", type="string", length=255)
     */
    private $procedencia;

    /**
     * @var int
     *
     * @ORM\Column(name="cupo", type="integer")
     */
    private $cupo;
    
    /**
     * @var int
     *
     * @ORM\Column(name="disponible", type="integer", nullable=true)
     */
    private $disponible;
    
     /**
     * @var int
     *
     * @ORM\Column(name="fecha", type="date", nullable=true)
     */
    private $fecha;
    
    

    /**
     * @var string
     *
     * @ORM\Column(name="dia", type="string", length=255)
     */
    private $dia;

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
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set turno
     *
     * @param string $turno
     *
     * @return Servicio
     */
    public function setTurno($turno) {
        $this->turno = $turno;

        return $this;
    }

    /**
     * Get turno
     *
     * @return string
     */
    public function getTurno() {
        return $this->turno;
    }

    /**
     * Set procedencia
     *
     * @param string $procedencia
     *
     * @return Servicio
     */
    public function setProcedencia($procedencia) {
        $this->procedencia = $procedencia;

        return $this;
    }

    /**
     * Get procedencia
     *
     * @return string
     */
    public function getProcedencia() {
        return $this->procedencia;
    }

    /**
     * Set cupo
     *
     * @param integer $cupo
     *
     * @return Servicio
     */
    public function setCupo($cupo) {
        $this->cupo = $cupo;

        return $this;
    }

    /**
     * Get cupo
     *
     * @return int
     */
    public function getCupo() {
        return $this->cupo;
    }

    /**
     * Set dia
     *
     * @param string $dia
     *
     * @return Servicio
     */
    public function setDia($dia) {
        $this->dia = $dia;

        return $this;
    }

    /**
     * Get dia
     *
     * @return string
     */
    public function getDia() {
        return $this->dia;
    }

    /**
     * Set especialidad
     *
     * @param \AppBundle\Entity\Especialidad $especialidad
     *
     * @return Servicio
     */
    public function setEspecialidad(\AppBundle\Entity\Especialidad $especialidad = null) {
        $this->especialidad = $especialidad;

        return $this;
    }

    /**
     * Get especialidad
     *
     * @return \AppBundle\Entity\Especialidad
     */
    public function getEspecialidad() {
        return $this->especialidad;
    }

   
    /**
     * Set disponible
     *
     * @param integer $disponible
     *
     * @return Servicio
     */
    public function setDisponible($disponible)
    {
        $this->disponible = $disponible;

        return $this;
    }

    /**
     * Get disponible
     *
     * @return integer
     */
    public function getDisponible()
    {
        return $this->disponible;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return Servicio
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
    
     public function __toString() {
        switch ($this->getDia()) {
            case 0:
                $_dia='Domingo';
                break;
            case 1:
               $_dia='Lunes';
                break;
            case 2:
                $_dia='Martes';
                break;
            case 3:
                $_dia='Miércoles';
                break;
            case 4:
                $_dia='Jueves';
                break;
            case 5:
                $_dia='Viernes';
                break;
            case 6:
                $_dia='Sábado';
                break;
        }
        return $this->getEspecialidad()->getNombre() . ' - ' .$_dia ;
    }
}

<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sicobiologico
 *
 * @ORM\Table(name="sicobiologico", indexes={@ORM\Index(name="IDX_82DAD52E7310DAD4", columns={"paciente_id"})})
 * @ORM\Entity
 */
class Sicobiologico {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var boolean
     *
     * @ORM\Column(name="alcohol", type="boolean", nullable=false)
     */
    private $alcohol = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="drogas", type="boolean", nullable=false)
     */
    private $drogas = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isecticidas", type="boolean", nullable=false)
     */
    private $isecticidas = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="deportes", type="boolean", nullable=false)
     */
    private $deportes = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="sedentarismo", type="boolean", nullable=false)
     */
    private $sedentarismo = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="suenio", type="boolean", nullable=false)
     */
    private $suenio = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="chupa_dedo", type="boolean", nullable=false)
     */
    private $chupaDedo = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="onicofagia", type="boolean", nullable=false)
     */
    private $onicofagia = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="micciones", type="boolean", nullable=false)
     */
    private $micciones = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="evacuaciones", type="boolean", nullable=false)
     */
    private $evacuaciones = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="stress", type="boolean", nullable=false)
     */
    private $stress = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="metales_pesados", type="boolean", nullable=false)
     */
    private $metalesPesados = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="alimentacion", type="boolean", nullable=false)
     */
    private $alimentacion = false;

    /**
     * @var string
     *
     * @ORM\Column(name="cigarrillos_dia", type="string", length=255, nullable=true)
     */
    private $cigarrillosDia;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_registro", type="date", nullable=false)
     */
    private $fechaRegistro;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_actualizacion", type="date", nullable=true)
     */
    private $fechaActualizacion;

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
    public function getId() {
        return $this->id;
    }

    /**
     * Set alcohol
     *
     * @param boolean $alcohol
     *
     * @return Sicobiologico
     */
    public function setAlcohol($alcohol) {
        $this->alcohol = $alcohol;

        return $this;
    }

    /**
     * Get alcohol
     *
     * @return boolean
     */
    public function getAlcohol() {
        return $this->alcohol;
    }

    /**
     * Set drogas
     *
     * @param boolean $drogas
     *
     * @return Sicobiologico
     */
    public function setDrogas($drogas) {
        $this->drogas = $drogas;

        return $this;
    }

    /**
     * Get drogas
     *
     * @return boolean
     */
    public function getDrogas() {
        return $this->drogas;
    }

    /**
     * Set isecticidas
     *
     * @param boolean $isecticidas
     *
     * @return Sicobiologico
     */
    public function setIsecticidas($isecticidas) {
        $this->isecticidas = $isecticidas;

        return $this;
    }

    /**
     * Get isecticidas
     *
     * @return boolean
     */
    public function getIsecticidas() {
        return $this->isecticidas;
    }

    /**
     * Set deportes
     *
     * @param boolean $deportes
     *
     * @return Sicobiologico
     */
    public function setDeportes($deportes) {
        $this->deportes = $deportes;

        return $this;
    }

    /**
     * Get deportes
     *
     * @return boolean
     */
    public function getDeportes() {
        return $this->deportes;
    }

    /**
     * Set sedentarismo
     *
     * @param boolean $sedentarismo
     *
     * @return Sicobiologico
     */
    public function setSedentarismo($sedentarismo) {
        $this->sedentarismo = $sedentarismo;

        return $this;
    }

    /**
     * Get sedentarismo
     *
     * @return boolean
     */
    public function getSedentarismo() {
        return $this->sedentarismo;
    }

    /**
     * Set suenio
     *
     * @param boolean $suenio
     *
     * @return Sicobiologico
     */
    public function setSuenio($suenio) {
        $this->suenio = $suenio;

        return $this;
    }

    /**
     * Get suenio
     *
     * @return boolean
     */
    public function getSuenio() {
        return $this->suenio;
    }

    /**
     * Set chupaDedo
     *
     * @param boolean $chupaDedo
     *
     * @return Sicobiologico
     */
    public function setChupaDedo($chupaDedo) {
        $this->chupaDedo = $chupaDedo;

        return $this;
    }

    /**
     * Get chupaDedo
     *
     * @return boolean
     */
    public function getChupaDedo() {
        return $this->chupaDedo;
    }

    /**
     * Set onicofagia
     *
     * @param boolean $onicofagia
     *
     * @return Sicobiologico
     */
    public function setOnicofagia($onicofagia) {
        $this->onicofagia = $onicofagia;

        return $this;
    }

    /**
     * Get onicofagia
     *
     * @return boolean
     */
    public function getOnicofagia() {
        return $this->onicofagia;
    }

    /**
     * Set micciones
     *
     * @param boolean $micciones
     *
     * @return Sicobiologico
     */
    public function setMicciones($micciones) {
        $this->micciones = $micciones;

        return $this;
    }

    /**
     * Get micciones
     *
     * @return boolean
     */
    public function getMicciones() {
        return $this->micciones;
    }

    /**
     * Set evacuaciones
     *
     * @param boolean $evacuaciones
     *
     * @return Sicobiologico
     */
    public function setEvacuaciones($evacuaciones) {
        $this->evacuaciones = $evacuaciones;

        return $this;
    }

    /**
     * Get evacuaciones
     *
     * @return boolean
     */
    public function getEvacuaciones() {
        return $this->evacuaciones;
    }

    /**
     * Set stress
     *
     * @param boolean $stress
     *
     * @return Sicobiologico
     */
    public function setStress($stress) {
        $this->stress = $stress;

        return $this;
    }

    /**
     * Get stress
     *
     * @return boolean
     */
    public function getStress() {
        return $this->stress;
    }

    /**
     * Set metalesPesados
     *
     * @param boolean $metalesPesados
     *
     * @return Sicobiologico
     */
    public function setMetalesPesados($metalesPesados) {
        $this->metalesPesados = $metalesPesados;

        return $this;
    }

    /**
     * Get metalesPesados
     *
     * @return boolean
     */
    public function getMetalesPesados() {
        return $this->metalesPesados;
    }

    /**
     * Set alimentacion
     *
     * @param boolean $alimentacion
     *
     * @return Sicobiologico
     */
    public function setAlimentacion($alimentacion) {
        $this->alimentacion = $alimentacion;

        return $this;
    }

    /**
     * Get alimentacion
     *
     * @return boolean
     */
    public function getAlimentacion() {
        return $this->alimentacion;
    }

    /**
     * Set cigarrillosDia
     *
     * @param boolean $cigarrillosDia
     *
     * @return Sicobiologico
     */
    public function setCigarrillosDia($cigarrillosDia) {
        $this->cigarrillosDia = $cigarrillosDia;

        return $this;
    }

    /**
     * Get cigarrillosDia
     *
     * @return boolean
     */
    public function getCigarrillosDia() {
        return $this->cigarrillosDia;
    }

    /**
     * Set fechaRegistro
     *
     * @param \DateTime $fechaRegistro
     *
     * @return Sicobiologico
     */
    public function setFechaRegistro($fechaRegistro) {
        $this->fechaRegistro = $fechaRegistro;

        return $this;
    }

    /**
     * Get fechaRegistro
     *
     * @return \DateTime
     */
    public function getFechaRegistro() {
        return $this->fechaRegistro;
    }

    /**
     * Set fechaActualizacion
     *
     * @param \DateTime $fechaActualizacion
     *
     * @return Sicobiologico
     */
    public function setFechaActualizacion($fechaActualizacion) {
        $this->fechaActualizacion = $fechaActualizacion;

        return $this;
    }

    /**
     * Get fechaActualizacion
     *
     * @return \DateTime
     */
    public function getFechaActualizacion() {
        return $this->fechaActualizacion;
    }

    /**
     * Set paciente
     *
     * @param \AppBundle\Entity\Paciente $paciente
     *
     * @return Sicobiologico
     */
    public function setPaciente(\AppBundle\Entity\Paciente $paciente = null) {
        $this->paciente = $paciente;

        return $this;
    }

    /**
     * Get paciente
     *
     * @return \AppBundle\Entity\Paciente
     */
    public function getPaciente() {
        return $this->paciente;
    }

}

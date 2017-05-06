<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sexualidad
 *
 * @ORM\Table(name="sexualidad", indexes={@ORM\Index(name="IDX_894685CE7310DAD4", columns={"paciente_id"})})
 * @ORM\Entity
 */
class Sexualidad
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
     * @var string
     *
     * @ORM\Column(name="menarquia", type="string", length=255, nullable=true)
     */
    private $menarquia;

    /**
     * @var string
     *
     * @ORM\Column(name="ciclo_menstrual", type="string", length=255, nullable=true)
     */
    private $cicloMenstrual;

    /**
     * @var string
     *
     * @ORM\Column(name="pr_sexual", type="string", length=255, nullable=true)
     */
    private $prSexual;
    /**
     * @var string
     *
     * @ORM\Column(name="frecuencia_sexual", type="string", length=255, nullable=true)
     */
    private $frecuenciaSexual;

    /**
     * @var integer
     *
     * @ORM\Column(name="numero_parejas", type="integer", nullable=true)
     */
    private $numeroParejas = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="dispareunia", type="boolean", nullable=true)
     */
    private $dispareunia = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="anticonceptivos", type="boolean", nullable=true)
     */
    private $anticonceptivos = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="menopausia", type="boolean", nullable=true)
     */
    private $menopausia = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="andropausia", type="boolean", nullable=true)
     */
    private $andropausia = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="gesta", type="boolean", nullable=true)
     */
    private $gesta = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="parto", type="boolean", nullable=true)
     */
    private $parto = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="cesarea", type="boolean", nullable=true)
     */
    private $cesarea = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="aborto", type="boolean", nullable=true)
     */
    private $aborto = false;

    /**
     * @var integer
     *
     * @ORM\Column(name="edad_1er_parto", type="integer", nullable=true)
     */
    private $edad1erParto;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_ultimo_parto", type="date", nullable=true)
     */
    private $fechaUltimoParto;

    /**
     * @var boolean
     *
     * @ORM\Column(name="curetaje", type="boolean", nullable=true)
     */
    private $curetaje = false;

    /**
     * @var integer
     *
     * @ORM\Column(name="numero_hijos_vivos", type="integer", nullable=true)
     */
    private $numeroHijosVivos = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="numero_hijos_muertos", type="integer", nullable=true)
     */
    private $numeroHijosMuertos = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="peso_ultimo_hijo", type="integer", nullable=true)
     */
    private $pesoUltimoHijo = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_actualizacion", type="date", nullable=true)
     */
    private $fechaActualizacion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_registro", type="date", nullable=false)
     */
    private $fechaRegistro;

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
     * Set menarquia
     *
     * @param string $menarquia
     *
     * @return Sexualidad
     */
    public function setMenarquia($menarquia)
    {
        $this->menarquia = $menarquia;

        return $this;
    }

    /**
     * Get menarquia
     *
     * @return string
     */
    public function getMenarquia()
    {
        return $this->menarquia;
    }

    /**
     * Set cicloMenstrual
     *
     * @param string $cicloMenstrual
     *
     * @return Sexualidad
     */
    public function setCicloMenstrual($cicloMenstrual)
    {
        $this->cicloMenstrual = $cicloMenstrual;

        return $this;
    }

    /**
     * Get cicloMenstrual
     *
     * @return string
     */
    public function getCicloMenstrual()
    {
        return $this->cicloMenstrual;
    }

    /**
     * Set prSexual
     *
     * @param string $prSexual
     *
     * @return Sexualidad
     */
    public function setPrSexual($prSexual)
    {
        $this->prSexual = $prSexual;

        return $this;
    }

    /**
     * Get prSexual
     *
     * @return string
     */
    public function getPrSexual()
    {
        return $this->prSexual;
    }

    /**
     * Set frecuenciaSexual
     *
     * @param string $frecuenciaSexual
     *
     * @return Sexualidad
     */
    public function setFrecuenciaSexual($frecuenciaSexual)
    {
        $this->frecuenciaSexual = $frecuenciaSexual;

        return $this;
    }

    /**
     * Get frecuenciaSexual
     *
     * @return string
     */
    public function getFrecuenciaSexual()
    {
        return $this->frecuenciaSexual;
    }

    /**
     * Set numeroParejas
     *
     * @param integer $numeroParejas
     *
     * @return Sexualidad
     */
    public function setNumeroParejas($numeroParejas)
    {
        $this->numeroParejas = $numeroParejas;

        return $this;
    }

    /**
     * Get numeroParejas
     *
     * @return integer
     */
    public function getNumeroParejas()
    {
        return $this->numeroParejas;
    }

    /**
     * Set dispareunia
     *
     * @param boolean $dispareunia
     *
     * @return Sexualidad
     */
    public function setDispareunia($dispareunia)
    {
        $this->dispareunia = $dispareunia;

        return $this;
    }

    /**
     * Get dispareunia
     *
     * @return boolean
     */
    public function getDispareunia()
    {
        return $this->dispareunia;
    }

    /**
     * Set anticonceptivos
     *
     * @param boolean $anticonceptivos
     *
     * @return Sexualidad
     */
    public function setAnticonceptivos($anticonceptivos)
    {
        $this->anticonceptivos = $anticonceptivos;

        return $this;
    }

    /**
     * Get anticonceptivos
     *
     * @return boolean
     */
    public function getAnticonceptivos()
    {
        return $this->anticonceptivos;
    }

    /**
     * Set menopausia
     *
     * @param boolean $menopausia
     *
     * @return Sexualidad
     */
    public function setMenopausia($menopausia)
    {
        $this->menopausia = $menopausia;

        return $this;
    }

    /**
     * Get menopausia
     *
     * @return boolean
     */
    public function getMenopausia()
    {
        return $this->menopausia;
    }

    /**
     * Set andropausia
     *
     * @param boolean $andropausia
     *
     * @return Sexualidad
     */
    public function setAndropausia($andropausia)
    {
        $this->andropausia = $andropausia;

        return $this;
    }

    /**
     * Get andropausia
     *
     * @return boolean
     */
    public function getAndropausia()
    {
        return $this->andropausia;
    }

    /**
     * Set gesta
     *
     * @param boolean $gesta
     *
     * @return Sexualidad
     */
    public function setGesta($gesta)
    {
        $this->gesta = $gesta;

        return $this;
    }

    /**
     * Get gesta
     *
     * @return boolean
     */
    public function getGesta()
    {
        return $this->gesta;
    }

    /**
     * Set parto
     *
     * @param boolean $parto
     *
     * @return Sexualidad
     */
    public function setParto($parto)
    {
        $this->parto = $parto;

        return $this;
    }

    /**
     * Get parto
     *
     * @return boolean
     */
    public function getParto()
    {
        return $this->parto;
    }

    /**
     * Set cesarea
     *
     * @param boolean $cesarea
     *
     * @return Sexualidad
     */
    public function setCesarea($cesarea)
    {
        $this->cesarea = $cesarea;

        return $this;
    }

    /**
     * Get cesarea
     *
     * @return boolean
     */
    public function getCesarea()
    {
        return $this->cesarea;
    }

    /**
     * Set aborto
     *
     * @param boolean $aborto
     *
     * @return Sexualidad
     */
    public function setAborto($aborto)
    {
        $this->aborto = $aborto;

        return $this;
    }

    /**
     * Get aborto
     *
     * @return boolean
     */
    public function getAborto()
    {
        return $this->aborto;
    }

    /**
     * Set edad1erParto
     *
     * @param integer $edad1erParto
     *
     * @return Sexualidad
     */
    public function setEdad1erParto($edad1erParto)
    {
        $this->edad1erParto = $edad1erParto;

        return $this;
    }

    /**
     * Get edad1erParto
     *
     * @return integer
     */
    public function getEdad1erParto()
    {
        return $this->edad1erParto;
    }

    /**
     * Set fechaUltimoParto
     *
     * @param \DateTime $fechaUltimoParto
     *
     * @return Sexualidad
     */
    public function setFechaUltimoParto($fechaUltimoParto)
    {
        $this->fechaUltimoParto = $fechaUltimoParto;

        return $this;
    }

    /**
     * Get fechaUltimoParto
     *
     * @return \DateTime
     */
    public function getFechaUltimoParto()
    {
        return $this->fechaUltimoParto;
    }

    /**
     * Set curetaje
     *
     * @param boolean $curetaje
     *
     * @return Sexualidad
     */
    public function setCuretaje($curetaje)
    {
        $this->curetaje = $curetaje;

        return $this;
    }

    /**
     * Get curetaje
     *
     * @return boolean
     */
    public function getCuretaje()
    {
        return $this->curetaje;
    }

    /**
     * Set numeroHijosVivos
     *
     * @param integer $numeroHijosVivos
     *
     * @return Sexualidad
     */
    public function setNumeroHijosVivos($numeroHijosVivos)
    {
        $this->numeroHijosVivos = $numeroHijosVivos;

        return $this;
    }

    /**
     * Get numeroHijosVivos
     *
     * @return integer
     */
    public function getNumeroHijosVivos()
    {
        return $this->numeroHijosVivos;
    }

    /**
     * Set numeroHijosMuertos
     *
     * @param integer $numeroHijosMuertos
     *
     * @return Sexualidad
     */
    public function setNumeroHijosMuertos($numeroHijosMuertos)
    {
        $this->numeroHijosMuertos = $numeroHijosMuertos;

        return $this;
    }

    /**
     * Get numeroHijosMuertos
     *
     * @return integer
     */
    public function getNumeroHijosMuertos()
    {
        return $this->numeroHijosMuertos;
    }

    /**
     * Set pesoUltimoHijo
     *
     * @param integer $pesoUltimoHijo
     *
     * @return Sexualidad
     */
    public function setPesoUltimoHijo($pesoUltimoHijo)
    {
        $this->pesoUltimoHijo = $pesoUltimoHijo;

        return $this;
    }

    /**
     * Get pesoUltimoHijo
     *
     * @return integer
     */
    public function getPesoUltimoHijo()
    {
        return $this->pesoUltimoHijo;
    }

    /**
     * Set fechaActualizacion
     *
     * @param \DateTime $fechaActualizacion
     *
     * @return Sexualidad
     */
    public function setFechaActualizacion($fechaActualizacion)
    {
        $this->fechaActualizacion = $fechaActualizacion;

        return $this;
    }

    /**
     * Get fechaActualizacion
     *
     * @return \DateTime
     */
    public function getFechaActualizacion()
    {
        return $this->fechaActualizacion;
    }

    /**
     * Set fechaRegistro
     *
     * @param \DateTime $fechaRegistro
     *
     * @return Sexualidad
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
     * Set paciente
     *
     * @param \AppBundle\Entity\Paciente $paciente
     *
     * @return Sexualidad
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

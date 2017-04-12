<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Antecendente
 *
 * @ORM\Table(name="antecedente", indexes={@ORM\Index(name="IDX_C24A09BC7310DAD4", columns={"paciente_id"})})
 * @ORM\Entity
 */
class Antecedente
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var boolean
     *
     * @ORM\Column(name="alergia", type="boolean", nullable=false)
     */
    private $alergia = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="asma", type="boolean", nullable=false)
     */
    private $asma = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="tbc", type="boolean", nullable=false)
     */
    private $tbc = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="cardiotopia", type="boolean", nullable=false)
     */
    private $cardiotopia = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="hipertension", type="boolean", nullable=false)
     */
    private $hipertension = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="varices", type="boolean", nullable=false)
     */
    private $varices = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="desnutricion", type="boolean", nullable=false)
     */
    private $desnutricion = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="diabetes", type="boolean", nullable=false)
     */
    private $diabetes = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="obesidad", type="boolean", nullable=false)
     */
    private $obesidad = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="gastropatia", type="boolean", nullable=false)
     */
    private $gastropatia = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="neurologica", type="boolean", nullable=false)
     */
    private $neurologica= false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="enfermedad_renal", type="boolean", nullable=false)
     */
    private $enfermedadRenal = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="cancer", type="boolean", nullable=false)
     */
    private $cancer = false;

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
     * @ORM\Column(name="sifilis", type="boolean", nullable=false)
     */
    private $sifilis = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="sida", type="boolean", nullable=false)
     */
    private $sida = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="artritis", type="boolean", nullable=false)
     */
    private $artritis = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="otros_padre", type="boolean", nullable=false)
     */
    private $otrosPadre = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="otros_madre", type="boolean", nullable=false)
     */
    private $otrosMadre = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="otros_hermanos", type="boolean", nullable=false)
     */
    private $otrosHermanos = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="otros", type="boolean", nullable=false)
     */
    private $otros = false;

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
     * Set alergia
     *
     * @param boolean $alergia
     *
     * @return Antecendente
     */
    public function setAlergia($alergia)
    {
        $this->alergia = $alergia;

        return $this;
    }

    /**
     * Get alergia
     *
     * @return boolean
     */
    public function getAlergia()
    {
        return $this->alergia;
    }

    /**
     * Set asma
     *
     * @param boolean $asma
     *
     * @return Antecendente
     */
    public function setAsma($asma)
    {
        $this->asma = $asma;

        return $this;
    }

    /**
     * Get asma
     *
     * @return boolean
     */
    public function getAsma()
    {
        return $this->asma;
    }

    /**
     * Set tbc
     *
     * @param boolean $tbc
     *
     * @return Antecendente
     */
    public function setTbc($tbc)
    {
        $this->tbc = $tbc;

        return $this;
    }

    /**
     * Get tbc
     *
     * @return boolean
     */
    public function getTbc()
    {
        return $this->tbc;
    }

    /**
     * Set cardiotopia
     *
     * @param boolean $cardiotopia
     *
     * @return Antecendente
     */
    public function setCardiotopia($cardiotopia)
    {
        $this->cardiotopia = $cardiotopia;

        return $this;
    }

    /**
     * Get cardiotopia
     *
     * @return boolean
     */
    public function getCardiotopia()
    {
        return $this->cardiotopia;
    }

    /**
     * Set hipertension
     *
     * @param boolean $hipertension
     *
     * @return Antecendente
     */
    public function setHipertension($hipertension)
    {
        $this->hipertension = $hipertension;

        return $this;
    }

    /**
     * Get hipertension
     *
     * @return boolean
     */
    public function getHipertension()
    {
        return $this->hipertension;
    }

    /**
     * Set varices
     *
     * @param boolean $varices
     *
     * @return Antecendente
     */
    public function setVarices($varices)
    {
        $this->varices = $varices;

        return $this;
    }

    /**
     * Get varices
     *
     * @return boolean
     */
    public function getVarices()
    {
        return $this->varices;
    }

    /**
     * Set desnutricion
     *
     * @param boolean $desnutricion
     *
     * @return Antecendente
     */
    public function setDesnutricion($desnutricion)
    {
        $this->desnutricion = $desnutricion;

        return $this;
    }

    /**
     * Get desnutricion
     *
     * @return boolean
     */
    public function getDesnutricion()
    {
        return $this->desnutricion;
    }

    /**
     * Set diabetes
     *
     * @param boolean $diabetes
     *
     * @return Antecendente
     */
    public function setDiabetes($diabetes)
    {
        $this->diabetes = $diabetes;

        return $this;
    }

    /**
     * Get diabetes
     *
     * @return boolean
     */
    public function getDiabetes()
    {
        return $this->diabetes;
    }

    /**
     * Set obesidad
     *
     * @param boolean $obesidad
     *
     * @return Antecendente
     */
    public function setObesidad($obesidad)
    {
        $this->obesidad = $obesidad;

        return $this;
    }

    /**
     * Get obesidad
     *
     * @return boolean
     */
    public function getObesidad()
    {
        return $this->obesidad;
    }

    /**
     * Set gastropatia
     *
     * @param boolean $gastropatia
     *
     * @return Antecendente
     */
    public function setGastropatia($gastropatia)
    {
        $this->gastropatia = $gastropatia;

        return $this;
    }

    /**
     * Get gastropatia
     *
     * @return boolean
     */
    public function getGastropatia()
    {
        return $this->gastropatia;
    }

   

    /**
     * Set enfermedadRenal
     *
     * @param boolean $enfermedadRenal
     *
     * @return Antecendente
     */
    public function setEnfermedadRenal($enfermedadRenal)
    {
        $this->enfermedadRenal = $enfermedadRenal;

        return $this;
    }

    /**
     * Get enfermedadRenal
     *
     * @return boolean
     */
    public function getEnfermedadRenal()
    {
        return $this->enfermedadRenal;
    }

    /**
     * Set cancer
     *
     * @param boolean $cancer
     *
     * @return Antecendente
     */
    public function setCancer($cancer)
    {
        $this->cancer = $cancer;

        return $this;
    }

    /**
     * Get cancer
     *
     * @return boolean
     */
    public function getCancer()
    {
        return $this->cancer;
    }

    /**
     * Set alcohol
     *
     * @param boolean $alcohol
     *
     * @return Antecendente
     */
    public function setAlcohol($alcohol)
    {
        $this->alcohol = $alcohol;

        return $this;
    }

    /**
     * Get alcohol
     *
     * @return boolean
     */
    public function getAlcohol()
    {
        return $this->alcohol;
    }

    /**
     * Set drogas
     *
     * @param boolean $drogas
     *
     * @return Antecendente
     */
    public function setDrogas($drogas)
    {
        $this->drogas = $drogas;

        return $this;
    }

    /**
     * Get drogas
     *
     * @return boolean
     */
    public function getDrogas()
    {
        return $this->drogas;
    }

    /**
     * Set sifilis
     *
     * @param boolean $sifilis
     *
     * @return Antecendente
     */
    public function setSifilis($sifilis)
    {
        $this->sifilis = $sifilis;

        return $this;
    }

    /**
     * Get sifilis
     *
     * @return boolean
     */
    public function getSifilis()
    {
        return $this->sifilis;
    }

    /**
     * Set sida
     *
     * @param boolean $sida
     *
     * @return Antecendente
     */
    public function setSida($sida)
    {
        $this->sida = $sida;

        return $this;
    }

    /**
     * Get sida
     *
     * @return boolean
     */
    public function getSida()
    {
        return $this->sida;
    }

    /**
     * Set artritis
     *
     * @param boolean $artritis
     *
     * @return Antecendente
     */
    public function setArtritis($artritis)
    {
        $this->artritis = $artritis;

        return $this;
    }

    /**
     * Get artritis
     *
     * @return boolean
     */
    public function getArtritis()
    {
        return $this->artritis;
    }

    /**
     * Set otrosPadre
     *
     * @param boolean $otrosPadre
     *
     * @return Antecendente
     */
    public function setOtrosPadre($otrosPadre)
    {
        $this->otrosPadre = $otrosPadre;

        return $this;
    }

    /**
     * Get otrosPadre
     *
     * @return boolean
     */
    public function getOtrosPadre()
    {
        return $this->otrosPadre;
    }

    /**
     * Set otrosMadre
     *
     * @param boolean $otrosMadre
     *
     * @return Antecendente
     */
    public function setOtrosMadre($otrosMadre)
    {
        $this->otrosMadre = $otrosMadre;

        return $this;
    }

    /**
     * Get otrosMadre
     *
     * @return boolean
     */
    public function getOtrosMadre()
    {
        return $this->otrosMadre;
    }

    /**
     * Set otrosHermanos
     *
     * @param boolean $otrosHermanos
     *
     * @return Antecendente
     */
    public function setOtrosHermanos($otrosHermanos)
    {
        $this->otrosHermanos = $otrosHermanos;

        return $this;
    }

    /**
     * Get otrosHermanos
     *
     * @return boolean
     */
    public function getOtrosHermanos()
    {
        return $this->otrosHermanos;
    }

    /**
     * Set otros
     *
     * @param boolean $otros
     *
     * @return Antecendente
     */
    public function setOtros($otros)
    {
        $this->otros = $otros;

        return $this;
    }

    /**
     * Get otros
     *
     * @return boolean
     */
    public function getOtros()
    {
        return $this->otros;
    }

    /**
     * Set fechaActualizacion
     *
     * @param \DateTime $fechaActualizacion
     *
     * @return Antecendente
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
     * @return Antecendente
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
     * @return Antecendente
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
     * Set neurologica
     *
     * @param boolean $neurologica
     *
     * @return Antecedente
     */
    public function setNeurologica($neurologica)
    {
        $this->neurologica = $neurologica;

        return $this;
    }

    /**
     * Get neurologica
     *
     * @return boolean
     */
    public function getNeurologica()
    {
        return $this->neurologica;
    }
}

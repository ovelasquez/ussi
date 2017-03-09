<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Patologia
 *
 * @ORM\Table(name="patologia", indexes={@ORM\Index(name="IDX_17FB1F757310DAD4", columns={"paciente_id"})})
 * @ORM\Entity
 */
class Patologia
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="patologia_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var boolean
     *
     * @ORM\Column(name="alergias", type="boolean", nullable=false)
     */
    private $alergias = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="asma", type="boolean", nullable=false)
     */
    private $asma = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="neumonia", type="boolean", nullable=false)
     */
    private $neumonia = false;

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
     * @ORM\Column(name="dislipidemias", type="boolean", nullable=false)
     */
    private $dislipidemias = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="varices", type="boolean", nullable=false)
     */
    private $varices = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="cardopatia_chag", type="boolean", nullable=false)
     */
    private $cardopatiaChag = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="hepatopatia", type="boolean", nullable=false)
     */
    private $hepatopatia = false;

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
     * @ORM\Column(name="gastroenteritis", type="boolean", nullable=false)
     */
    private $gastroenteritis = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="encoprexis", type="boolean", nullable=false)
     */
    private $encoprexis = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="enfermedad_renal", type="boolean", nullable=false)
     */
    private $enfermedadRenal = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="eunereis", type="boolean", nullable=false)
     */
    private $eunereis = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="cancer", type="boolean", nullable=false)
     */
    private $cancer = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="tromboembolia", type="boolean", nullable=false)
     */
    private $tromboembolia = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="tumor_m", type="boolean", nullable=false)
     */
    private $tumorM = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="meningitis", type="boolean", nullable=false)
     */
    private $meningitis = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="t_craneoenc", type="boolean", nullable=false)
     */
    private $tCraneoenc = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="enfermedad_erup", type="boolean", nullable=false)
     */
    private $enfermedadErup = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="dengue", type="boolean", nullable=false)
     */
    private $dengue = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="hospitalizacion", type="boolean", nullable=false)
     */
    private $hospitalizacion = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="intervencion_quirurgica", type="boolean", nullable=false)
     */
    private $intervencionQuirurgica = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="accidente", type="boolean", nullable=false)
     */
    private $accidente = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="artritis", type="boolean", nullable=false)
     */
    private $artritis = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="enfermedad_ts", type="boolean", nullable=false)
     */
    private $enfermedadTs = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="enfermedad_in_tran", type="boolean", nullable=false)
     */
    private $enfermedadInTran = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="malaria", type="boolean", nullable=false)
     */
    private $malaria = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="hansen_leishmar", type="boolean", nullable=false)
     */
    private $hansenLeishmar = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="otros", type="boolean", nullable=false)
     */
    private $otros = false;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_registro", type="date", nullable=false)
     */
    private $fechaRegistro;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_actualizacion", type="date", nullable=false)
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
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set alergias
     *
     * @param boolean $alergias
     *
     * @return Patologia
     */
    public function setAlergias($alergias)
    {
        $this->alergias = $alergias;

        return $this;
    }

    /**
     * Get alergias
     *
     * @return boolean
     */
    public function getAlergias()
    {
        return $this->alergias;
    }

    /**
     * Set asma
     *
     * @param boolean $asma
     *
     * @return Patologia
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
     * Set neumonia
     *
     * @param boolean $neumonia
     *
     * @return Patologia
     */
    public function setNeumonia($neumonia)
    {
        $this->neumonia = $neumonia;

        return $this;
    }

    /**
     * Get neumonia
     *
     * @return boolean
     */
    public function getNeumonia()
    {
        return $this->neumonia;
    }

    /**
     * Set tbc
     *
     * @param boolean $tbc
     *
     * @return Patologia
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
     * @return Patologia
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
     * @return Patologia
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
     * Set dislipidemias
     *
     * @param boolean $dislipidemias
     *
     * @return Patologia
     */
    public function setDislipidemias($dislipidemias)
    {
        $this->dislipidemias = $dislipidemias;

        return $this;
    }

    /**
     * Get dislipidemias
     *
     * @return boolean
     */
    public function getDislipidemias()
    {
        return $this->dislipidemias;
    }

    /**
     * Set varices
     *
     * @param boolean $varices
     *
     * @return Patologia
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
     * Set cardopatiaChag
     *
     * @param boolean $cardopatiaChag
     *
     * @return Patologia
     */
    public function setCardopatiaChag($cardopatiaChag)
    {
        $this->cardopatiaChag = $cardopatiaChag;

        return $this;
    }

    /**
     * Get cardopatiaChag
     *
     * @return boolean
     */
    public function getCardopatiaChag()
    {
        return $this->cardopatiaChag;
    }

    /**
     * Set hepatopatia
     *
     * @param boolean $hepatopatia
     *
     * @return Patologia
     */
    public function setHepatopatia($hepatopatia)
    {
        $this->hepatopatia = $hepatopatia;

        return $this;
    }

    /**
     * Get hepatopatia
     *
     * @return boolean
     */
    public function getHepatopatia()
    {
        return $this->hepatopatia;
    }

    /**
     * Set desnutricion
     *
     * @param boolean $desnutricion
     *
     * @return Patologia
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
     * @return Patologia
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
     * @return Patologia
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
     * Set gastroenteritis
     *
     * @param boolean $gastroenteritis
     *
     * @return Patologia
     */
    public function setGastroenteritis($gastroenteritis)
    {
        $this->gastroenteritis = $gastroenteritis;

        return $this;
    }

    /**
     * Get gastroenteritis
     *
     * @return boolean
     */
    public function getGastroenteritis()
    {
        return $this->gastroenteritis;
    }

    /**
     * Set encoprexis
     *
     * @param boolean $encoprexis
     *
     * @return Patologia
     */
    public function setEncoprexis($encoprexis)
    {
        $this->encoprexis = $encoprexis;

        return $this;
    }

    /**
     * Get encoprexis
     *
     * @return boolean
     */
    public function getEncoprexis()
    {
        return $this->encoprexis;
    }

    /**
     * Set enfermedadRenal
     *
     * @param boolean $enfermedadRenal
     *
     * @return Patologia
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
     * Set eunereis
     *
     * @param boolean $eunereis
     *
     * @return Patologia
     */
    public function setEunereis($eunereis)
    {
        $this->eunereis = $eunereis;

        return $this;
    }

    /**
     * Get eunereis
     *
     * @return boolean
     */
    public function getEunereis()
    {
        return $this->eunereis;
    }

    /**
     * Set cancer
     *
     * @param boolean $cancer
     *
     * @return Patologia
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
     * Set tromboembolia
     *
     * @param boolean $tromboembolia
     *
     * @return Patologia
     */
    public function setTromboembolia($tromboembolia)
    {
        $this->tromboembolia = $tromboembolia;

        return $this;
    }

    /**
     * Get tromboembolia
     *
     * @return boolean
     */
    public function getTromboembolia()
    {
        return $this->tromboembolia;
    }

    /**
     * Set tumorM
     *
     * @param boolean $tumorM
     *
     * @return Patologia
     */
    public function setTumorM($tumorM)
    {
        $this->tumorM = $tumorM;

        return $this;
    }

    /**
     * Get tumorM
     *
     * @return boolean
     */
    public function getTumorM()
    {
        return $this->tumorM;
    }

    /**
     * Set meningitis
     *
     * @param boolean $meningitis
     *
     * @return Patologia
     */
    public function setMeningitis($meningitis)
    {
        $this->meningitis = $meningitis;

        return $this;
    }

    /**
     * Get meningitis
     *
     * @return boolean
     */
    public function getMeningitis()
    {
        return $this->meningitis;
    }

    /**
     * Set tCraneoenc
     *
     * @param boolean $tCraneoenc
     *
     * @return Patologia
     */
    public function setTCraneoenc($tCraneoenc)
    {
        $this->tCraneoenc = $tCraneoenc;

        return $this;
    }

    /**
     * Get tCraneoenc
     *
     * @return boolean
     */
    public function getTCraneoenc()
    {
        return $this->tCraneoenc;
    }

    /**
     * Set enfermedadErup
     *
     * @param boolean $enfermedadErup
     *
     * @return Patologia
     */
    public function setEnfermedadErup($enfermedadErup)
    {
        $this->enfermedadErup = $enfermedadErup;

        return $this;
    }

    /**
     * Get enfermedadErup
     *
     * @return boolean
     */
    public function getEnfermedadErup()
    {
        return $this->enfermedadErup;
    }

    /**
     * Set dengue
     *
     * @param boolean $dengue
     *
     * @return Patologia
     */
    public function setDengue($dengue)
    {
        $this->dengue = $dengue;

        return $this;
    }

    /**
     * Get dengue
     *
     * @return boolean
     */
    public function getDengue()
    {
        return $this->dengue;
    }

    /**
     * Set hospitalizacion
     *
     * @param boolean $hospitalizacion
     *
     * @return Patologia
     */
    public function setHospitalizacion($hospitalizacion)
    {
        $this->hospitalizacion = $hospitalizacion;

        return $this;
    }

    /**
     * Get hospitalizacion
     *
     * @return boolean
     */
    public function getHospitalizacion()
    {
        return $this->hospitalizacion;
    }

    /**
     * Set intervencionQuirurgica
     *
     * @param boolean $intervencionQuirurgica
     *
     * @return Patologia
     */
    public function setIntervencionQuirurgica($intervencionQuirurgica)
    {
        $this->intervencionQuirurgica = $intervencionQuirurgica;

        return $this;
    }

    /**
     * Get intervencionQuirurgica
     *
     * @return boolean
     */
    public function getIntervencionQuirurgica()
    {
        return $this->intervencionQuirurgica;
    }

    /**
     * Set accidente
     *
     * @param boolean $accidente
     *
     * @return Patologia
     */
    public function setAccidente($accidente)
    {
        $this->accidente = $accidente;

        return $this;
    }

    /**
     * Get accidente
     *
     * @return boolean
     */
    public function getAccidente()
    {
        return $this->accidente;
    }

    /**
     * Set artritis
     *
     * @param boolean $artritis
     *
     * @return Patologia
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
     * Set enfermedadTs
     *
     * @param boolean $enfermedadTs
     *
     * @return Patologia
     */
    public function setEnfermedadTs($enfermedadTs)
    {
        $this->enfermedadTs = $enfermedadTs;

        return $this;
    }

    /**
     * Get enfermedadTs
     *
     * @return boolean
     */
    public function getEnfermedadTs()
    {
        return $this->enfermedadTs;
    }

    /**
     * Set enfermedadInTran
     *
     * @param boolean $enfermedadInTran
     *
     * @return Patologia
     */
    public function setEnfermedadInTran($enfermedadInTran)
    {
        $this->enfermedadInTran = $enfermedadInTran;

        return $this;
    }

    /**
     * Get enfermedadInTran
     *
     * @return boolean
     */
    public function getEnfermedadInTran()
    {
        return $this->enfermedadInTran;
    }

    /**
     * Set malaria
     *
     * @param boolean $malaria
     *
     * @return Patologia
     */
    public function setMalaria($malaria)
    {
        $this->malaria = $malaria;

        return $this;
    }

    /**
     * Get malaria
     *
     * @return boolean
     */
    public function getMalaria()
    {
        return $this->malaria;
    }

    /**
     * Set hansenLeishmar
     *
     * @param boolean $hansenLeishmar
     *
     * @return Patologia
     */
    public function setHansenLeishmar($hansenLeishmar)
    {
        $this->hansenLeishmar = $hansenLeishmar;

        return $this;
    }

    /**
     * Get hansenLeishmar
     *
     * @return boolean
     */
    public function getHansenLeishmar()
    {
        return $this->hansenLeishmar;
    }

    /**
     * Set otros
     *
     * @param boolean $otros
     *
     * @return Patologia
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
     * Set fechaRegistro
     *
     * @param \DateTime $fechaRegistro
     *
     * @return Patologia
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
     * Set fechaActualizacion
     *
     * @param \DateTime $fechaActualizacion
     *
     * @return Patologia
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
     * Set paciente
     *
     * @param \AppBundle\Entity\Paciente $paciente
     *
     * @return Patologia
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

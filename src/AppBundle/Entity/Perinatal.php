<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Perinatal
 *
 * @ORM\Table(name="perinatal", indexes={@ORM\Index(name="IDX_142F08677310DAD4", columns={"paciente_id"})})
 * @ORM\Entity
 */
class Perinatal
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
     * @ORM\Column(name="carnet_perinatal", type="boolean", nullable=true)
     */
    private $carnetPerinatal = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="patologia_embarazo", type="boolean", nullable=true)
     */
    private $patologiaEmbarazo = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="patologia_parto", type="boolean", nullable=true)
     */
    private $patologiaParto = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="patologia_puerperio", type="boolean", nullable=true)
     */
    private $patologiaPuerperio = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="consultas_prenatales", type="boolean", nullable=true)
     */
    private $consultasPrenatales = false;

    /**
     * @var integer
     *
     * @ORM\Column(name="edad_gestacional", type="integer", nullable=true)
     */
    private $edadGestacional;

    /**
     * @var boolean
     *
     * @ORM\Column(name="forceps", type="boolean", nullable=true)
     */
    private $forceps = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="cesarea", type="boolean", nullable=true)
     */
    private $cesarea = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="parto", type="boolean", nullable=true)
     */
    private $parto = false;

    /**
     * @var integer
     *
     * @ORM\Column(name="peso_nacer", type="integer", nullable=true)
     */
    private $pesoNacer;

    /**
     * @var integer
     *
     * @ORM\Column(name="talla", type="integer", nullable=true)
     */
    private $talla;

    /**
     * @var integer
     *
     * @ORM\Column(name="circunferencia", type="integer", nullable=true)
     */
    private $circunferencia;

    /**
     * @var boolean
     *
     * @ORM\Column(name="apagar_min", type="boolean", nullable=true)
     */
    private $apagarMin = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="asfixia", type="boolean", nullable=true)
     */
    private $asfixia = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="reanimacion", type="boolean", nullable=true)
     */
    private $reanimacion = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="patologias_rn", type="boolean", nullable=true)
     */
    private $patologiasRn = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="egreso_rn_sano", type="boolean", nullable=true)
     */
    private $egresoRnSano = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="egreso_rn_patologico", type="boolean", nullable=true)
     */
    private $egresoRnPatologico = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="lactancia_exclusiva", type="boolean", nullable=true)
     */
    private $lactanciaExclusiva = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="lactancia_mixta", type="boolean", nullable=true)
     */
    private $lactanciaMixta = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="lactancia_aglactacion", type="boolean", nullable=true)
     */
    private $lactanciaAglactacion = false;

    /**
     * @var integer
     *
     * @ORM\Column(name="madre_fuera_casa", type="integer", nullable=true)
     */
    private $madreFueraCasa;

    /**
     * @var boolean
     *
     * @ORM\Column(name="familia_madre", type="boolean", nullable=true)
     */
    private $familiaMadre = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="familia_padre", type="boolean", nullable=true)
     */
    private $familiaPadre = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="familia_hermanos", type="boolean", nullable=true)
     */
    private $familiaHermanos = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="familia_otros", type="boolean", nullable=true)
     */
    private $familiaOtros = false;

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
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set carnetPerinatal
     *
     * @param boolean $carnetPerinatal
     *
     * @return Perinatal
     */
    public function setCarnetPerinatal($carnetPerinatal)
    {
        $this->carnetPerinatal = $carnetPerinatal;

        return $this;
    }

    /**
     * Get carnetPerinatal
     *
     * @return boolean
     */
    public function getCarnetPerinatal()
    {
        return $this->carnetPerinatal;
    }

    /**
     * Set patologiaEmbarazo
     *
     * @param boolean $patologiaEmbarazo
     *
     * @return Perinatal
     */
    public function setPatologiaEmbarazo($patologiaEmbarazo)
    {
        $this->patologiaEmbarazo = $patologiaEmbarazo;

        return $this;
    }

    /**
     * Get patologiaEmbarazo
     *
     * @return boolean
     */
    public function getPatologiaEmbarazo()
    {
        return $this->patologiaEmbarazo;
    }

    /**
     * Set patologiaParto
     *
     * @param boolean $patologiaParto
     *
     * @return Perinatal
     */
    public function setPatologiaParto($patologiaParto)
    {
        $this->patologiaParto = $patologiaParto;

        return $this;
    }

    /**
     * Get patologiaParto
     *
     * @return boolean
     */
    public function getPatologiaParto()
    {
        return $this->patologiaParto;
    }

    /**
     * Set patologiaPuerperio
     *
     * @param boolean $patologiaPuerperio
     *
     * @return Perinatal
     */
    public function setPatologiaPuerperio($patologiaPuerperio)
    {
        $this->patologiaPuerperio = $patologiaPuerperio;

        return $this;
    }

    /**
     * Get patologiaPuerperio
     *
     * @return boolean
     */
    public function getPatologiaPuerperio()
    {
        return $this->patologiaPuerperio;
    }

    /**
     * Set consultasPrenatales
     *
     * @param boolean $consultasPrenatales
     *
     * @return Perinatal
     */
    public function setConsultasPrenatales($consultasPrenatales)
    {
        $this->consultasPrenatales = $consultasPrenatales;

        return $this;
    }

    /**
     * Get consultasPrenatales
     *
     * @return boolean
     */
    public function getConsultasPrenatales()
    {
        return $this->consultasPrenatales;
    }

    /**
     * Set edadGestacional
     *
     * @param integer $edadGestacional
     *
     * @return Perinatal
     */
    public function setEdadGestacional($edadGestacional)
    {
        $this->edadGestacional = $edadGestacional;

        return $this;
    }

    /**
     * Get edadGestacional
     *
     * @return integer
     */
    public function getEdadGestacional()
    {
        return $this->edadGestacional;
    }

    /**
     * Set forceps
     *
     * @param boolean $forceps
     *
     * @return Perinatal
     */
    public function setForceps($forceps)
    {
        $this->forceps = $forceps;

        return $this;
    }

    /**
     * Get forceps
     *
     * @return boolean
     */
    public function getForceps()
    {
        return $this->forceps;
    }

    /**
     * Set cesarea
     *
     * @param boolean $cesarea
     *
     * @return Perinatal
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
     * Set parto
     *
     * @param boolean $parto
     *
     * @return Perinatal
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
     * Set pesoNacer
     *
     * @param integer $pesoNacer
     *
     * @return Perinatal
     */
    public function setPesoNacer($pesoNacer)
    {
        $this->pesoNacer = $pesoNacer;

        return $this;
    }

    /**
     * Get pesoNacer
     *
     * @return integer
     */
    public function getPesoNacer()
    {
        return $this->pesoNacer;
    }

    /**
     * Set talla
     *
     * @param integer $talla
     *
     * @return Perinatal
     */
    public function setTalla($talla)
    {
        $this->talla = $talla;

        return $this;
    }

    /**
     * Get talla
     *
     * @return integer
     */
    public function getTalla()
    {
        return $this->talla;
    }

    /**
     * Set circunferencia
     *
     * @param integer $circunferencia
     *
     * @return Perinatal
     */
    public function setCircunferencia($circunferencia)
    {
        $this->circunferencia = $circunferencia;

        return $this;
    }

    /**
     * Get circunferencia
     *
     * @return integer
     */
    public function getCircunferencia()
    {
        return $this->circunferencia;
    }

    /**
     * Set apagarMin
     *
     * @param boolean $apagarMin
     *
     * @return Perinatal
     */
    public function setApagarMin($apagarMin)
    {
        $this->apagarMin = $apagarMin;

        return $this;
    }

    /**
     * Get apagarMin
     *
     * @return boolean
     */
    public function getApagarMin()
    {
        return $this->apagarMin;
    }

    /**
     * Set asfixia
     *
     * @param boolean $asfixia
     *
     * @return Perinatal
     */
    public function setAsfixia($asfixia)
    {
        $this->asfixia = $asfixia;

        return $this;
    }

    /**
     * Get asfixia
     *
     * @return boolean
     */
    public function getAsfixia()
    {
        return $this->asfixia;
    }

    /**
     * Set reanimacion
     *
     * @param boolean $reanimacion
     *
     * @return Perinatal
     */
    public function setReanimacion($reanimacion)
    {
        $this->reanimacion = $reanimacion;

        return $this;
    }

    /**
     * Get reanimacion
     *
     * @return boolean
     */
    public function getReanimacion()
    {
        return $this->reanimacion;
    }

    /**
     * Set patologiasRn
     *
     * @param boolean $patologiasRn
     *
     * @return Perinatal
     */
    public function setPatologiasRn($patologiasRn)
    {
        $this->patologiasRn = $patologiasRn;

        return $this;
    }

    /**
     * Get patologiasRn
     *
     * @return boolean
     */
    public function getPatologiasRn()
    {
        return $this->patologiasRn;
    }

    /**
     * Set egresoRnSano
     *
     * @param boolean $egresoRnSano
     *
     * @return Perinatal
     */
    public function setEgresoRnSano($egresoRnSano)
    {
        $this->egresoRnSano = $egresoRnSano;

        return $this;
    }

    /**
     * Get egresoRnSano
     *
     * @return boolean
     */
    public function getEgresoRnSano()
    {
        return $this->egresoRnSano;
    }

    /**
     * Set egresoRnPatologico
     *
     * @param boolean $egresoRnPatologico
     *
     * @return Perinatal
     */
    public function setEgresoRnPatologico($egresoRnPatologico)
    {
        $this->egresoRnPatologico = $egresoRnPatologico;

        return $this;
    }

    /**
     * Get egresoRnPatologico
     *
     * @return boolean
     */
    public function getEgresoRnPatologico()
    {
        return $this->egresoRnPatologico;
    }

    /**
     * Set lactanciaExclusiva
     *
     * @param boolean $lactanciaExclusiva
     *
     * @return Perinatal
     */
    public function setLactanciaExclusiva($lactanciaExclusiva)
    {
        $this->lactanciaExclusiva = $lactanciaExclusiva;

        return $this;
    }

    /**
     * Get lactanciaExclusiva
     *
     * @return boolean
     */
    public function getLactanciaExclusiva()
    {
        return $this->lactanciaExclusiva;
    }

    /**
     * Set lactanciaMixta
     *
     * @param boolean $lactanciaMixta
     *
     * @return Perinatal
     */
    public function setLactanciaMixta($lactanciaMixta)
    {
        $this->lactanciaMixta = $lactanciaMixta;

        return $this;
    }

    /**
     * Get lactanciaMixta
     *
     * @return boolean
     */
    public function getLactanciaMixta()
    {
        return $this->lactanciaMixta;
    }

    /**
     * Set lactanciaAglactacion
     *
     * @param boolean $lactanciaAglactacion
     *
     * @return Perinatal
     */
    public function setLactanciaAglactacion($lactanciaAglactacion)
    {
        $this->lactanciaAglactacion = $lactanciaAglactacion;

        return $this;
    }

    /**
     * Get lactanciaAglactacion
     *
     * @return boolean
     */
    public function getLactanciaAglactacion()
    {
        return $this->lactanciaAglactacion;
    }

    /**
     * Set madreFueraCasa
     *
     * @param integer $madreFueraCasa
     *
     * @return Perinatal
     */
    public function setMadreFueraCasa($madreFueraCasa)
    {
        $this->madreFueraCasa = $madreFueraCasa;

        return $this;
    }

    /**
     * Get madreFueraCasa
     *
     * @return integer
     */
    public function getMadreFueraCasa()
    {
        return $this->madreFueraCasa;
    }

    /**
     * Set familiaMadre
     *
     * @param boolean $familiaMadre
     *
     * @return Perinatal
     */
    public function setFamiliaMadre($familiaMadre)
    {
        $this->familiaMadre = $familiaMadre;

        return $this;
    }

    /**
     * Get familiaMadre
     *
     * @return boolean
     */
    public function getFamiliaMadre()
    {
        return $this->familiaMadre;
    }

    /**
     * Set familiaPadre
     *
     * @param boolean $familiaPadre
     *
     * @return Perinatal
     */
    public function setFamiliaPadre($familiaPadre)
    {
        $this->familiaPadre = $familiaPadre;

        return $this;
    }

    /**
     * Get familiaPadre
     *
     * @return boolean
     */
    public function getFamiliaPadre()
    {
        return $this->familiaPadre;
    }

    /**
     * Set familiaHermanos
     *
     * @param boolean $familiaHermanos
     *
     * @return Perinatal
     */
    public function setFamiliaHermanos($familiaHermanos)
    {
        $this->familiaHermanos = $familiaHermanos;

        return $this;
    }

    /**
     * Get familiaHermanos
     *
     * @return boolean
     */
    public function getFamiliaHermanos()
    {
        return $this->familiaHermanos;
    }

    /**
     * Set familiaOtros
     *
     * @param boolean $familiaOtros
     *
     * @return Perinatal
     */
    public function setFamiliaOtros($familiaOtros)
    {
        $this->familiaOtros = $familiaOtros;

        return $this;
    }

    /**
     * Get familiaOtros
     *
     * @return boolean
     */
    public function getFamiliaOtros()
    {
        return $this->familiaOtros;
    }

    /**
     * Set fechaRegistro
     *
     * @param \DateTime $fechaRegistro
     *
     * @return Perinatal
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
     * @return Perinatal
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
     * @return Perinatal
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

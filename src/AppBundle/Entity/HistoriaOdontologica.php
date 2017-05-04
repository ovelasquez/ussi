<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * HistoriaOdontologica
 *
 * @ORM\Table(name="historia_odontologica")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\HistoriaOdontologicaRepository")
 */
class HistoriaOdontologica {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

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
     * @var string
     *
     * @ORM\Column(name="tratamientoMedico", type="text")
     */
    private $tratamientoMedico;

    /**
     * @var string
     *
     * @ORM\Column(name="medicamentoActual", type="text")
     */
    private $medicamentoActual;

    /**
     * @var string
     *
     * @ORM\Column(name="alergia", type="text")
     */
    private $alergia;

    /**
     * @var string
     *
     * @ORM\Column(name="ultimaVisitaOdontologo", type="string", length=255)
     */
    private $ultimaVisitaOdontologo;

    /**
     * @var string
     *
     * @ORM\Column(name="tratamientoAplicado", type="text")
     */
    private $tratamientoAplicado;

    /**
     * @var string
     *
     * @ORM\Column(name="dolorBoca", type="text")
     */
    private $dolorBoca;

    /**
     * @var bool
     *
     * @ORM\Column(name="sangreEncias", type="boolean")
     */
    private $sangreEncias;

    /**
     * @var string
     *
     * @ORM\Column(name="habitos", type="text")
     */
    private $habitos;

    /**
     * @var string
     *
     * @ORM\Column(name="presionArterial", type="string", length=255)
     */
    private $presionArterial;

    /**
     * @var string
     *
     * @ORM\Column(name="hepatitis", type="string", length=255)
     */
    private $hepatitis;

    /**
     * @var string
     *
     * @ORM\Column(name="tbc", type="string", length=255)
     */
    private $tbc;

    /**
     * @var string
     *
     * @ORM\Column(name="enfermedadRespiratoria", type="string", length=255)
     */
    private $enfermedadRespiratoria;

    /**
     * @var string
     *
     * @ORM\Column(name="enfermedadCardiovascular", type="string", length=255)
     */
    private $enfermedadCardiovascular;

    /**
     * @var string
     *
     * @ORM\Column(name="enfermedadHemorragica", type="string", length=255)
     */
    private $enfermedadHemorragica;

    /**
     * @var string
     *
     * @ORM\Column(name="enfermedadOtra", type="string", length=255)
     */
    private $enfermedadOtra;

    /**
     * @var string
     *
     * @ORM\Column(name="enfermedadFamiliar", type="string", length=255)
     */
    private $enfermedadFamiliar;

    /**
     * @var bool
     *
     * @ORM\Column(name="estaEmbarazada", type="boolean")
     */
    private $estaEmbarazada;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="text")
     */
    private $observaciones;

    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    
    /**
     * Set tratamientoMedico
     *
     * @param string $tratamientoMedico
     *
     * @return HistoriaOdontologica
     */
    public function setTratamientoMedico($tratamientoMedico) {
        $this->tratamientoMedico = $tratamientoMedico;

        return $this;
    }

    /**
     * Get tratamientoMedico
     *
     * @return string
     */
    public function getTratamientoMedico() {
        return $this->tratamientoMedico;
    }

    /**
     * Set medicamentoActual
     *
     * @param string $medicamentoActual
     *
     * @return HistoriaOdontologica
     */
    public function setMedicamentoActual($medicamentoActual) {
        $this->medicamentoActual = $medicamentoActual;

        return $this;
    }

    /**
     * Get medicamentoActual
     *
     * @return string
     */
    public function getMedicamentoActual() {
        return $this->medicamentoActual;
    }

    /**
     * Set alergia
     *
     * @param string $alergia
     *
     * @return HistoriaOdontologica
     */
    public function setAlergia($alergia) {
        $this->alergia = $alergia;

        return $this;
    }

    /**
     * Get alergia
     *
     * @return string
     */
    public function getAlergia() {
        return $this->alergia;
    }

    /**
     * Set ultimaVisitaOdontologo
     *
     * @param string $ultimaVisitaOdontologo
     *
     * @return HistoriaOdontologica
     */
    public function setUltimaVisitaOdontologo($ultimaVisitaOdontologo) {
        $this->ultimaVisitaOdontologo = $ultimaVisitaOdontologo;

        return $this;
    }

    /**
     * Get ultimaVisitaOdontologo
     *
     * @return string
     */
    public function getUltimaVisitaOdontologo() {
        return $this->ultimaVisitaOdontologo;
    }

    /**
     * Set tratamientoAplicado
     *
     * @param string $tratamientoAplicado
     *
     * @return HistoriaOdontologica
     */
    public function setTratamientoAplicado($tratamientoAplicado) {
        $this->tratamientoAplicado = $tratamientoAplicado;

        return $this;
    }

    /**
     * Get tratamientoAplicado
     *
     * @return string
     */
    public function getTratamientoAplicado() {
        return $this->tratamientoAplicado;
    }

    /**
     * Set dolorBoca
     *
     * @param string $dolorBoca
     *
     * @return HistoriaOdontologica
     */
    public function setDolorBoca($dolorBoca) {
        $this->dolorBoca = $dolorBoca;

        return $this;
    }

    /**
     * Get dolorBoca
     *
     * @return string
     */
    public function getDolorBoca() {
        return $this->dolorBoca;
    }

    /**
     * Set sangreEncias
     *
     * @param boolean $sangreEncias
     *
     * @return HistoriaOdontologica
     */
    public function setSangreEncias($sangreEncias) {
        $this->sangreEncias = $sangreEncias;

        return $this;
    }

    /**
     * Get sangreEncias
     *
     * @return bool
     */
    public function getSangreEncias() {
        return $this->sangreEncias;
    }

    /**
     * Set habitos
     *
     * @param string $habitos
     *
     * @return HistoriaOdontologica
     */
    public function setHabitos($habitos) {
        $this->habitos = $habitos;

        return $this;
    }

    /**
     * Get habitos
     *
     * @return string
     */
    public function getHabitos() {
        return $this->habitos;
    }

    /**
     * Set presionArterial
     *
     * @param string $presionArterial
     *
     * @return HistoriaOdontologica
     */
    public function setPresionArterial($presionArterial) {
        $this->presionArterial = $presionArterial;

        return $this;
    }

    /**
     * Get presionArterial
     *
     * @return string
     */
    public function getPresionArterial() {
        return $this->presionArterial;
    }

    /**
     * Set hepatitis
     *
     * @param string $hepatitis
     *
     * @return HistoriaOdontologica
     */
    public function setHepatitis($hepatitis) {
        $this->hepatitis = $hepatitis;

        return $this;
    }

    /**
     * Get hepatitis
     *
     * @return string
     */
    public function getHepatitis() {
        return $this->hepatitis;
    }

    /**
     * Set tbc
     *
     * @param string $tbc
     *
     * @return HistoriaOdontologica
     */
    public function setTbc($tbc) {
        $this->tbc = $tbc;

        return $this;
    }

    /**
     * Get tbc
     *
     * @return string
     */
    public function getTbc() {
        return $this->tbc;
    }

    /**
     * Set enfermedadRespiratoria
     *
     * @param string $enfermedadRespiratoria
     *
     * @return HistoriaOdontologica
     */
    public function setEnfermedadRespiratoria($enfermedadRespiratoria) {
        $this->enfermedadRespiratoria = $enfermedadRespiratoria;

        return $this;
    }

    /**
     * Get enfermedadRespiratoria
     *
     * @return string
     */
    public function getEnfermedadRespiratoria() {
        return $this->enfermedadRespiratoria;
    }

    /**
     * Set enfermedadCardiovascular
     *
     * @param string $enfermedadCardiovascular
     *
     * @return HistoriaOdontologica
     */
    public function setEnfermedadCardiovascular($enfermedadCardiovascular) {
        $this->enfermedadCardiovascular = $enfermedadCardiovascular;

        return $this;
    }

    /**
     * Get enfermedadCardiovascular
     *
     * @return string
     */
    public function getEnfermedadCardiovascular() {
        return $this->enfermedadCardiovascular;
    }

    /**
     * Set enfermedadHemorragica
     *
     * @param string $enfermedadHemorragica
     *
     * @return HistoriaOdontologica
     */
    public function setEnfermedadHemorragica($enfermedadHemorragica) {
        $this->enfermedadHemorragica = $enfermedadHemorragica;

        return $this;
    }

    /**
     * Get enfermedadHemorragica
     *
     * @return string
     */
    public function getEnfermedadHemorragica() {
        return $this->enfermedadHemorragica;
    }

    /**
     * Set enfermedadOtra
     *
     * @param string $enfermedadOtra
     *
     * @return HistoriaOdontologica
     */
    public function setEnfermedadOtra($enfermedadOtra) {
        $this->enfermedadOtra = $enfermedadOtra;

        return $this;
    }

    /**
     * Get enfermedadOtra
     *
     * @return string
     */
    public function getEnfermedadOtra() {
        return $this->enfermedadOtra;
    }

    /**
     * Set enfermedadFamiliar
     *
     * @param string $enfermedadFamiliar
     *
     * @return HistoriaOdontologica
     */
    public function setEnfermedadFamiliar($enfermedadFamiliar) {
        $this->enfermedadFamiliar = $enfermedadFamiliar;

        return $this;
    }

    /**
     * Get enfermedadFamiliar
     *
     * @return string
     */
    public function getEnfermedadFamiliar() {
        return $this->enfermedadFamiliar;
    }

    /**
     * Set estaEmbarazada
     *
     * @param boolean $estaEmbarazada
     *
     * @return HistoriaOdontologica
     */
    public function setEstaEmbarazada($estaEmbarazada) {
        $this->estaEmbarazada = $estaEmbarazada;

        return $this;
    }

    /**
     * Get estaEmbarazada
     *
     * @return bool
     */
    public function getEstaEmbarazada() {
        return $this->estaEmbarazada;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     *
     * @return HistoriaOdontologica
     */
    public function setObservaciones($observaciones) {
        $this->observaciones = $observaciones;

        return $this;
    }

    /**
     * Get observaciones
     *
     * @return string
     */
    public function getObservaciones() {
        return $this->observaciones;
    }


    /**
     * Set paciente
     *
     * @param \AppBundle\Entity\Paciente $paciente
     *
     * @return HistoriaOdontologica
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

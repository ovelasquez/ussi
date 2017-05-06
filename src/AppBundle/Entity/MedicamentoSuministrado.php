<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MedicamentoSuministrado
 *
 * @ORM\Table(name="medicamento_suministrado")
 * @ORM\Entity
 */
class MedicamentoSuministrado
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\SequenceGenerator(sequenceName="medicamentos_suministrados_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="cantidad", type="integer", nullable=false)
     */
    private $cantidad;

    /**
     * @var string
     *
     * @ORM\Column(name="via_administracion", type="string", length=255, nullable=false)
     */
    private $viaAdministracion;

   
    /**
     * @var \Consulta
     *
     * @ORM\ManyToOne(targetEntity="Consulta")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="consulta_id", referencedColumnName="id", onDelete="CASCADE")
     * })
     */
    private $consulta;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $usuario;

    /**
     * @var \Medicamento
     *
     * @ORM\ManyToOne(targetEntity="Medicamento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="medicamento_id", referencedColumnName="id")
     * })
     */
    private $medicamento;
    
        /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime", nullable=false)
     */
    private $fecha;



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
     * Set cantidad
     *
     * @param integer $cantidad
     * @return MedicamentoSuministrado
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;
    
        return $this;
    }

    /**
     * Get cantidad
     *
     * @return integer 
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Set viaAdministracion
     *
     * @param string $viaAdministracion
     * @return MedicamentoSuministrado
     */
    public function setViaAdministracion($viaAdministracion)
    {
        $this->viaAdministracion = $viaAdministracion;
    
        return $this;
    }

    /**
     * Get viaAdministracion
     *
     * @return string 
     */
    public function getViaAdministracion()
    {
        return $this->viaAdministracion;
    }

    
    /**
     * Set consulta
     *
     * @param \AppBundle\Entity\Consultas $consulta
     * @return MedicamentoSuministrado
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
     * Set medicamento
     *
     * @param \AppBundle\Entity\Medicamento $medicamento
     * @return MedicamentoSuministrado
     */
    public function setMedicamento(\AppBundle\Entity\Medicamento $medicamento = null)
    {
        $this->medicamento = $medicamento;
    
        return $this;
    }

    /**
     * Get medicamento
     *
     * @return \AppBundle\Entity\Medicamento 
     */
    public function getMedicamento()
    {
        return $this->medicamento;
    }

    /**
     * Set usuario
     *
     * @param \AppBundle\Entity\User $usuario
     *
     * @return MedicamentoSuministrado
     */
    public function setUsuario(\AppBundle\Entity\User $usuario = null)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get usuario
     *
     * @return \AppBundle\Entity\User
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return MedicamentoSuministrado
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
}

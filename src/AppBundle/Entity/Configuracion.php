<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Configuracion
 *
 * @ORM\Table(name="configuracion")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ConfiguracionRepository")
 */
class Configuracion
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="numero_consultas", type="smallint", nullable=true)
     */
    private $numeroConsultas;
    
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="servicio_actualizado", type="date", nullable=true)
     */
    private $servicioActualizado;
    
     /**
     * @var integer
     *
     * @ORM\Column(name="tiempo_espera", type="integer", nullable=true)
     */
    private $tiempoEspera = '0';
    
    /**
     * @var integer
     *
     * @ORM\Column(name="penalizacion", type="integer", nullable=true)
     */
    private $penalizacion = '0';

    /**
     * @var \Campania
     *
     * @ORM\ManyToOne(targetEntity="Campania")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="campania_id", referencedColumnName="id")
     * })
     */
    private $campania;
    
    
       /**
     * @var string
     *
     * @ORM\Column(name="template_reposo", type="text",  nullable=true)
     */
    private $templateReposo;
    
      /**
     * @var string
     *
     * @ORM\Column(name="template_constancia", type="text",  nullable=true)
     */
    private $templateConstancia;


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
     * Set numeroConsultas
     *
     * @param integer $numeroConsultas
     *
     * @return Configuracion
     */
    public function setNumeroConsultas($numeroConsultas)
    {
        $this->numeroConsultas = $numeroConsultas;

        return $this;
    }

    /**
     * Get numeroConsultas
     *
     * @return int
     */
    public function getNumeroConsultas()
    {
        return $this->numeroConsultas;
    }

    /**
     * Set servicioActualizado
     *
     * @param \DateTime $servicioActualizado
     *
     * @return Configuracion
     */
    public function setServicioActualizado($servicioActualizado)
    {
        $this->servicioActualizado = $servicioActualizado;

        return $this;
    }

    /**
     * Get servicioActualizado
     *
     * @return \DateTime
     */
    public function getServicioActualizado()
    {
        return $this->servicioActualizado;
    }



    /**
     * Set penalizacion
     *
     * @param integer $penalizacion
     *
     * @return Configuracion
     */
    public function setPenalizacion($penalizacion)
    {
        $this->penalizacion = $penalizacion;

        return $this;
    }

    /**
     * Get penalizacion
     *
     * @return integer
     */
    public function getPenalizacion()
    {
        return $this->penalizacion;
    }

    /**
     * Set tiempoEspera
     *
     * @param integer $tiempoEspera
     *
     * @return Configuracion
     */
    public function setTiempoEspera($tiempoEspera)
    {
        $this->tiempoEspera = $tiempoEspera;

        return $this;
    }

    /**
     * Get tiempoEspera
     *
     * @return integer
     */
    public function getTiempoEspera()
    {
        return $this->tiempoEspera;
    }

    /**
     * Set campania
     *
     * @param \AppBundle\Entity\Campania $campania
     *
     * @return Configuracion
     */
    public function setCampania(\AppBundle\Entity\Campania $campania = null)
    {
        $this->campania = $campania;

        return $this;
    }

    /**
     * Get campania
     *
     * @return \AppBundle\Entity\Campania
     */
    public function getCampania()
    {
        return $this->campania;
    }

    /**
     * Set templateReposo
     *
     * @param string $templateReposo
     *
     * @return Configuracion
     */
    public function setTemplateReposo($templateReposo)
    {
        $this->templateReposo = $templateReposo;

        return $this;
    }

    /**
     * Get templateReposo
     *
     * @return string
     */
    public function getTemplateReposo()
    {
        return $this->templateReposo;
    }

    /**
     * Set templateConstancia
     *
     * @param string $templateConstancia
     *
     * @return Configuracion
     */
    public function setTemplateConstancia($templateConstancia)
    {
        $this->templateConstancia = $templateConstancia;

        return $this;
    }

    /**
     * Get templateConstancia
     *
     * @return string
     */
    public function getTemplateConstancia()
    {
        return $this->templateConstancia;
    }
}

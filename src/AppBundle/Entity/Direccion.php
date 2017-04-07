<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Direccion
 *
 * @ORM\Table(name="direccion", indexes={@ORM\Index(name="idx_f384be9574afdc17", columns={"parroquia_id"})})
 * @ORM\Entity
 */
class Direccion
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
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=255, nullable=false)
     */
    private $tipo;

    /**
     * @var string
     *
     * @ORM\Column(name="sector", type="string", length=255, nullable=true)
     */
    private $sector;

    /**
     * @var \Parroquia
     *
     * @ORM\ManyToOne(targetEntity="Parroquia")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="parroquia_id", referencedColumnName="id")
     * })
     */
    private $parroquia;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Paciente", mappedBy="direccion")
     */
    private $paciente;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->paciente = new \Doctrine\Common\Collections\ArrayCollection();
    }


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
     * Set tipo
     *
     * @param string $tipo
     *
     * @return Direccion
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return string
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set sector
     *
     * @param string $sector
     *
     * @return Direccion
     */
    public function setSector($sector)
    {
        $this->sector = $sector;

        return $this;
    }

    /**
     * Get sector
     *
     * @return string
     */
    public function getSector()
    {
        return $this->sector;
    }

    /**
     * Set parroquia
     *
     * @param \AppBundle\Entity\Parroquia $parroquia
     *
     * @return Direccion
     */
    public function setParroquia(\AppBundle\Entity\Parroquia $parroquia = null)
    {
        $this->parroquia = $parroquia;

        return $this;
    }

    /**
     * Get parroquia
     *
     * @return \AppBundle\Entity\Parroquia
     */
    public function getParroquia()
    {
        return $this->parroquia;
    }

    /**
     * Add paciente
     *
     * @param \AppBundle\Entity\Paciente $paciente
     *
     * @return Direccion
     */
    public function addPaciente(\AppBundle\Entity\Paciente $paciente)
    {
        $this->paciente[] = $paciente;

        return $this;
    }

    /**
     * Remove paciente
     *
     * @param \AppBundle\Entity\Paciente $paciente
     */
    public function removePaciente(\AppBundle\Entity\Paciente $paciente)
    {
        $this->paciente->removeElement($paciente);
    }

    /**
     * Get paciente
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPaciente()
    {
        return $this->paciente;
    }
}

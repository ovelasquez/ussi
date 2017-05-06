<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Familiar
 *
 * @ORM\Table(name="familiar", indexes={@ORM\Index(name="idx_cfd67cdb7cac4034", columns={"parentesco"})})
 * @ORM\Entity
 */
class Familiar
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
     * @ORM\Column(name="parentesco", type="string", length=255, nullable=false)
     */
    private $parentesco;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="ocupacion", type="string", length=255, nullable=false)
     */
    private $ocupacion;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Paciente", mappedBy="familiar")
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
     * Set parentesco
     *
     * @param string $parentesco
     *
     * @return Familiar
     */
    public function setParentesco($parentesco)
    {
        $this->parentesco = $parentesco;

        return $this;
    }

    /**
     * Get parentesco
     *
     * @return string
     */
    public function getParentesco()
    {
        return $this->parentesco;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Familiar
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set ocupacion
     *
     * @param string $ocupacion
     *
     * @return Familiar
     */
    public function setOcupacion($ocupacion)
    {
        $this->ocupacion = $ocupacion;

        return $this;
    }

    /**
     * Get ocupacion
     *
     * @return string
     */
    public function getOcupacion()
    {
        return $this->ocupacion;
    }

    /**
     * Add paciente
     *
     * @param \AppBundle\Entity\Paciente $paciente
     *
     * @return Familiar
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

<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Afeccione
 *
 * @ORM\Table(name="afeccione")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AfeccioneRepository")
 */
class Afeccione {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="diagnostico", type="text", nullable=false)
     */
    private $diagnostico = false;

    /**
     * @var string
     *
     * @ORM\Column(name="tratamiento", type="text", nullable=false)
     */
    private $tratamiento = false;

    /**
     * @var \Consulta
     *
     * @ORM\ManyToOne(targetEntity="Consulta")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="consulta_id", referencedColumnName="id")
     * })
     */
    private $consulta;

    /**
     * @var \EntericaElemento
     *
     * @ORM\ManyToOne(targetEntity="EntericaElemento",cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="enterica_elemento_id", referencedColumnName="id")
     * })
     */
    private $entericaElemento;

   

    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }


    /**
     * Set diagnostico
     *
     * @param string $diagnostico
     *
     * @return Afeccione
     */
    public function setDiagnostico($diagnostico)
    {
        $this->diagnostico = $diagnostico;

        return $this;
    }

    /**
     * Get diagnostico
     *
     * @return string
     */
    public function getDiagnostico()
    {
        return $this->diagnostico;
    }

    /**
     * Set tratamiento
     *
     * @param string $tratamiento
     *
     * @return Afeccione
     */
    public function setTratamiento($tratamiento)
    {
        $this->tratamiento = $tratamiento;

        return $this;
    }

    /**
     * Get tratamiento
     *
     * @return string
     */
    public function getTratamiento()
    {
        return $this->tratamiento;
    }

    /**
     * Set consulta
     *
     * @param \AppBundle\Entity\Consulta $consulta
     *
     * @return Afeccione
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
     * Set entericaElemento
     *
     * @param \AppBundle\Entity\EntericaElemento $entericaElemento
     *
     * @return Afeccione
     */
    public function setEntericaElemento(\AppBundle\Entity\EntericaElemento $entericaElemento = null)
    {
        $this->entericaElemento = $entericaElemento;

        return $this;
    }

    /**
     * Get entericaElemento
     *
     * @return \AppBundle\Entity\EntericaElemento
     */
    public function getEntericaElemento()
    {
        return $this->entericaElemento;
    }
}

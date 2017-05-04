<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Odontograma
 *
 * @ORM\Table(name="odontograma")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\OdontogramaRepository")
 */
class Odontograma
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \Diente
     *
     * @ORM\ManyToOne(targetEntity="Diente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="diente_id", referencedColumnName="id")
     * })
     */
    private $diente;

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
     * @var \Cavidad1
     *
     * @ORM\ManyToOne(targetEntity="Tratamiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cavidad_1", referencedColumnName="id")
     * })
     */
    private $cavidad1;

    /**
     * @var \Cavidad2
     *
     * @ORM\ManyToOne(targetEntity="Tratamiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cavidad_2", referencedColumnName="id")
     * })
     */
    private $cavidad2;

    /**
     * @var \Cavidad3
     *
     * @ORM\ManyToOne(targetEntity="Tratamiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cavidad_3", referencedColumnName="id")
     * })
     */
    private $cavidad3;

    /**
     * @var \Cavidad4
     *
     * @ORM\ManyToOne(targetEntity="Tratamiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cavidad_4", referencedColumnName="id")
     * })
     */
    private $cavidad4;

    /**
     * @var \Cavidad5
     *
     * @ORM\ManyToOne(targetEntity="Tratamiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cavidad_5", referencedColumnName="id")
     * })
     */
    private $cavidad5;


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
     * Set diente
     *
     * @param \AppBundle\Entity\Diente $diente
     *
     * @return Odontograma
     */
    public function setDiente(\AppBundle\Entity\Diente $diente = null)
    {
        $this->diente = $diente;

        return $this;
    }

    /**
     * Get diente
     *
     * @return \AppBundle\Entity\Diente
     */
    public function getDiente()
    {
        return $this->diente;
    }

    /**
     * Set consulta
     *
     * @param \AppBundle\Entity\Consulta $consulta
     *
     * @return Odontograma
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
     * Set cavidad1
     *
     * @param \AppBundle\Entity\Tratamiento $cavidad1
     *
     * @return Odontograma
     */
    public function setCavidad1(\AppBundle\Entity\Tratamiento $cavidad1 = null)
    {
        $this->cavidad1 = $cavidad1;

        return $this;
    }

    /**
     * Get cavidad1
     *
     * @return \AppBundle\Entity\Tratamiento
     */
    public function getCavidad1()
    {
        return $this->cavidad1;
    }

    /**
     * Set cavidad2
     *
     * @param \AppBundle\Entity\Tratamiento $cavidad2
     *
     * @return Odontograma
     */
    public function setCavidad2(\AppBundle\Entity\Tratamiento $cavidad2 = null)
    {
        $this->cavidad2 = $cavidad2;

        return $this;
    }

    /**
     * Get cavidad2
     *
     * @return \AppBundle\Entity\Tratamiento
     */
    public function getCavidad2()
    {
        return $this->cavidad2;
    }

    /**
     * Set cavidad3
     *
     * @param \AppBundle\Entity\Tratamiento $cavidad3
     *
     * @return Odontograma
     */
    public function setCavidad3(\AppBundle\Entity\Tratamiento $cavidad3 = null)
    {
        $this->cavidad3 = $cavidad3;

        return $this;
    }

    /**
     * Get cavidad3
     *
     * @return \AppBundle\Entity\Tratamiento
     */
    public function getCavidad3()
    {
        return $this->cavidad3;
    }

    /**
     * Set cavidad4
     *
     * @param \AppBundle\Entity\Tratamiento $cavidad4
     *
     * @return Odontograma
     */
    public function setCavidad4(\AppBundle\Entity\Tratamiento $cavidad4 = null)
    {
        $this->cavidad4 = $cavidad4;

        return $this;
    }

    /**
     * Get cavidad4
     *
     * @return \AppBundle\Entity\Tratamiento
     */
    public function getCavidad4()
    {
        return $this->cavidad4;
    }

    /**
     * Set cavidad5
     *
     * @param \AppBundle\Entity\Tratamiento $cavidad5
     *
     * @return Odontograma
     */
    public function setCavidad5(\AppBundle\Entity\Tratamiento $cavidad5 = null)
    {
        $this->cavidad5 = $cavidad5;

        return $this;
    }

    /**
     * Get cavidad5
     *
     * @return \AppBundle\Entity\Tratamiento
     */
    public function getCavidad5()
    {
        return $this->cavidad5;
    }
}

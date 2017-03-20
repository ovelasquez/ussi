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
}


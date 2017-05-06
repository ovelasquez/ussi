<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Diente
 *
 * @ORM\Table(name="diente")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DienteRepository")
 */
class Diente {

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
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var int
     *
     * @ORM\Column(name="cuadrante", type="smallint")
     */
    private $cuadrante;

    /**
     * @var int
     *
     * @ORM\Column(name="posicion", type="smallint")
     */
    private $posicion;
    
     /**
     * @var string
     *
     * @ORM\Column(name="identificador", type="string", length=255, nullable=true)
     */
    private $identificador;

    

    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Diente
     */
    public function setNombre($nombre) {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre() {
        return $this->nombre;
    }

    /**
     * Set cuadrante
     *
     * @param integer $cuadrante
     *
     * @return Diente
     */
    public function setCuadrante($cuadrante) {
        $this->cuadrante = $cuadrante;

        return $this;
    }

    /**
     * Get cuadrante
     *
     * @return int
     */
    public function getCuadrante() {
        return $this->cuadrante;
    }

    /**
     * Set posicion
     *
     * @param integer $posicion
     *
     * @return Diente
     */
    public function setPosicion($posicion) {
        $this->posicion = $posicion;

        return $this;
    }

    /**
     * Get posicion
     *
     * @return int
     */
    public function getPosicion() {
        return $this->posicion;
    }
    
    
    
    

    public function __toString() {
        return (string)$this->getPosicion().' - '.$this->getNombre();
    }
   

    /**
     * Set identificador
     *
     * @param string $identificador
     *
     * @return Diente
     */
    public function setIdentificador($identificador)
    {
        $this->identificador = $identificador;

        return $this;
    }

    /**
     * Get identificador
     *
     * @return string
     */
    public function getIdentificador()
    {
        return $this->identificador;
    }
}

<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tratamiento
 *
 * @ORM\Table(name="tratamiento")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TratamientoRepository")
 */
class Tratamiento {

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
     * @var string
     *
     * @ORM\Column(name="color", type="string", length=255)
     */
    private $color;

    /**
     * @var bool
     *
     * @ORM\Column(name="cavidad", type="boolean")
     */
    private $cavidad;

    /**
     * @var bool
     *
     * @ORM\Column(name="todo", type="boolean")
     */
    private $todo;

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
     * @return Tratamiento
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
     * Set color
     *
     * @param string $color
     *
     * @return Tratamiento
     */
    public function setColor($color) {
        $this->color = $color;

        return $this;
    }

    /**
     * Get color
     *
     * @return string
     */
    public function getColor() {
        return $this->color;
    }

    /**
     * Set cavidad
     *
     * @param boolean $cavidad
     *
     * @return Tratamiento
     */
    public function setCavidad($cavidad) {
        $this->cavidad = $cavidad;

        return $this;
    }

    /**
     * Get cavidad
     *
     * @return bool
     */
    public function getCavidad() {
        return $this->cavidad;
    }

    /**
     * Set todo
     *
     * @param boolean $todo
     *
     * @return Tratamiento
     */
    public function setTodo($todo) {
        $this->todo = $todo;

        return $this;
    }

    /**
     * Get todo
     *
     * @return bool
     */
    public function getTodo() {
        return $this->todo;
    }

    public function __toString() {
        return $this->getNombre();
    }

}

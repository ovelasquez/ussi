<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Campania
 *
 * @ORM\Table(name="campania")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CampaniaRepository")
 */
class Campania
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
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=true)
     */
    private $nombre;

      /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Imagen", inversedBy="campania", cascade="persist")
     * @ORM\JoinTable(name="campania_imagen",
     *   joinColumns={
     *     @ORM\JoinColumn(name="campania_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="imagen_id", referencedColumnName="id")
     *   }
     * )
     */      
      private $imagen;


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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Campania
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
     * Constructor
     */
    public function __construct()
    {
        $this->imagen = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add imagen
     *
     * @param \AppBundle\Entity\Imagen $imagen
     *
     * @return Campania
     */
    public function addImagen(\AppBundle\Entity\Imagen $imagen)
    {
        $this->imagen[] = $imagen;

        return $this;
    }

    /**
     * Remove imagen
     *
     * @param \AppBundle\Entity\Imagen $imagen
     */
    public function removeImagen(\AppBundle\Entity\Imagen $imagen)
    {
        $this->imagen->removeElement($imagen);
    }

    /**
     * Get imagen
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getImagen()
    {
        return $this->imagen;
    }

    public function __toString() {
        return $this->getNombre();
    }
}

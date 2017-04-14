<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Imagenes
 *
 * @ORM\Table(name="imagen")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ImagenesRepository")
 */
class Imagen
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
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     * @Assert\File(
     *     maxSize = "1024k",
     *     mimeTypes = {"image/jpeg", "image/jpg", "image/png"},
     *     mimeTypesMessage = "Carga una imagen válida: .jpg - .jpeg - .png"
     * )
     * @Assert\Image(
     *     minWidth = 1280,
     *     minHeight = 720,     
     *     allowLandscape = true,
     *     allowPortrait = false
     * )
     */
    private $nombre;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Campania", mappedBy="imagen")
     */
    private $campania;


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
     * Constructor
     */
    public function __construct()
    {
        $this->campania = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add campanium
     *
     * @param \AppBundle\Entity\Campania $campanium
     *
     * @return Imagen
     */
    public function addCampanium(\AppBundle\Entity\Campania $campanium)
    {
        $this->campania[] = $campanium;

        return $this;
    }

    /**
     * Remove campanium
     *
     * @param \AppBundle\Entity\Campania $campanium
     */
    public function removeCampanium(\AppBundle\Entity\Campania $campanium)
    {
        $this->campania->removeElement($campanium);
    }

    /**
     * Get campania
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCampania()
    {
        return $this->campania;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Imagen
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

     public function __toString() {
        return (string) $this->getNombre();
    }
}

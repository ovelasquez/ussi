<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EntericaGrupo
 *
 * @ORM\Table(name="enterica_grupo")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EntericaGrupoRepository")
 */
class EntericaGrupo
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
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;
  
    /**
     * @var \EntericaCapitulo
     *
     * @ORM\ManyToOne(targetEntity="EntericaCapitulo",cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="entericaCapitulo_id", referencedColumnName="id")
     * })
     */
    private $entericaCapitulo;


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
     * @return EntericaGrupo
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
     * Set entericaCapitulo
     *
     * @param \stdClass $entericaCapitulo
     *
     * @return EntericaGrupo
     */
    public function setEntericaCapitulo($entericaCapitulo)
    {
        $this->entericaCapitulo = $entericaCapitulo;

        return $this;
    }

    /**
     * Get entericaCapitulo
     *
     * @return \stdClass
     */
    public function getEntericaCapitulo()
    {
        return $this->entericaCapitulo;
    }
    
    public function __toString() {
        return $this->getNombre();
    }
}

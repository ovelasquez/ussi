<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EntericaElemento
 *
 * @ORM\Table(name="enterica_elemento")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EntericaElementoRepository")
 */
class EntericaElemento
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
     * @ORM\Column(name="codigo", type="string", length=255)
     */
    private $codigo;

    /**
     * @var text
     *
     * @ORM\Column(name="nombre", type="text")
     */
    private $nombre;

    
    /**
     * @var \EntericaGrupo
     *
     * @ORM\ManyToOne(targetEntity="EntericaGrupo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="entericaGrupo_id", referencedColumnName="id")
     * })
     */
    private $entericaGrupo;


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
     * Set codigo
     *
     * @param string $codigo
     *
     * @return EntericaElemento
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * Get codigo
     *
     * @return string
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    
    /**
     * Set entericaGrupo
     *
     * @param \stdClass $entericaGrupo
     *
     * @return EntericaElemento
     */
    public function setEntericaGrupo($entericaGrupo)
    {
        $this->entericaGrupo = $entericaGrupo;

        return $this;
    }

    /**
     * Get entericaGrupo
     *
     * @return \stdClass
     */
    public function getEntericaGrupo()
    {
        return $this->entericaGrupo;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return EntericaElemento
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
}

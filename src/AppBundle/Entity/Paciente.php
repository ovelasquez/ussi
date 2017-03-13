<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Paciente
 *
 * @ORM\Table(name="paciente", indexes={@ORM\Index(name="idx_c6cba95eb7850cbd", columns={"religion_id"}), @ORM\Index(name="idx_c6cba95e9363fd17", columns={"pfg_id"}), @ORM\Index(name="IDX_C6CBA95E594872DC", columns={"etnia_id"}), @ORM\Index(name="IDX_C6CBA95EF5F88DB9", columns={"persona_id"})})
 * @ORM\Entity
 */
class Paciente
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="paciente_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="edo_civil", type="string", length=255, nullable=false)
     */
    private $edoCivil;

    /**
     * @var string
     *
     * @ORM\Column(name="ocupacion", type="string", length=255, nullable=false)
     */
    private $ocupacion;

    /**
     * @var string
     *
     * @ORM\Column(name="estudio", type="string", length=255, nullable=false)
     */
    private $estudio;

    /**
     * @var string
     *
     * @ORM\Column(name="ano_aprobado", type="string", length=255, nullable=false)
     */
    private $anoAprobado;

    /**
     * @var boolean
     *
     * @ORM\Column(name="analfabeta", type="boolean", nullable=false)
     */
    private $analfabeta;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_nacimiento", type="date", nullable=false)
     */
    private $fechaNacimiento;

    /**
     * @var string
     *
     * @ORM\Column(name="procedencia", type="string", length=255, nullable=false)
     */
    private $procedencia;

    /**
     * @var string
     *
     * @ORM\Column(name="apellido_familia", type="string", length=255, nullable=false)
     */
    private $apellidoFamilia;

    /**
     * @var string
     *
     * @ORM\Column(name="cedula_jefe_familia", type="string", length=255, nullable=false)
     */
    private $cedulaJefeFamilia;

    /**
     * @var string
     *
     * @ORM\Column(name="comunidad", type="string", length=255, nullable=false)
     */
    private $comunidad;

    /**
     * @var \Religion
     *
     * @ORM\ManyToOne(targetEntity="Religion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="religion_id", referencedColumnName="id")
     * })
     */
    private $religion;

    /**
     * @var \Pfg
     *
     * @ORM\ManyToOne(targetEntity="Pfg")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="pfg_id", referencedColumnName="id")
     * })
     */
    private $pfg;

    /**
     * @var \Etnia
     *
     * @ORM\ManyToOne(targetEntity="Etnia")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="etnia_id", referencedColumnName="id")
     * })
     */
    private $etnia;

    /**
     * @var \Persona
     *
     * @ORM\ManyToOne(targetEntity="Persona", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="persona_id", referencedColumnName="id")
     * })
     */
    private $persona;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Direccion", inversedBy="paciente", cascade="persist")
     * @ORM\JoinTable(name="paciente_direccion",
     *   joinColumns={
     *     @ORM\JoinColumn(name="paciente_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="direccion_id", referencedColumnName="id")
     *   }
     * )
     */
    private $direccion;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Familiar", inversedBy="paciente", cascade="persist")
     * @ORM\JoinTable(name="paciente_familiar",
     *   joinColumns={
     *     @ORM\JoinColumn(name="paciente_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="familiar_id", referencedColumnName="id")
     *   }
     * )
     */
    private $familiar;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_actualizacion", type="datetime", nullable=true)
     */
    private $fechaActualizacion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_registro", type="datetime", nullable=true)
     */
    private $fechaRegistro;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->direccion = new \Doctrine\Common\Collections\ArrayCollection();
        $this->familiar = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set edoCivil
     *
     * @param string $edoCivil
     *
     * @return Paciente
     */
    public function setEdoCivil($edoCivil)
    {
        $this->edoCivil = $edoCivil;

        return $this;
    }

    /**
     * Get edoCivil
     *
     * @return string
     */
    public function getEdoCivil()
    {
        return $this->edoCivil;
    }

    /**
     * Set ocupacion
     *
     * @param string $ocupacion
     *
     * @return Paciente
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
     * Set estudio
     *
     * @param string $estudio
     *
     * @return Paciente
     */
    public function setEstudio($estudio)
    {
        $this->estudio = $estudio;

        return $this;
    }

    /**
     * Get estudio
     *
     * @return string
     */
    public function getEstudio()
    {
        return $this->estudio;
    }

    /**
     * Set anoAprobado
     *
     * @param string $anoAprobado
     *
     * @return Paciente
     */
    public function setAnoAprobado($anoAprobado)
    {
        $this->anoAprobado = $anoAprobado;

        return $this;
    }

    /**
     * Get anoAprobado
     *
     * @return string
     */
    public function getAnoAprobado()
    {
        return $this->anoAprobado;
    }

    /**
     * Set analfabeta
     *
     * @param boolean $analfabeta
     *
     * @return Paciente
     */
    public function setAnalfabeta($analfabeta)
    {
        $this->analfabeta = $analfabeta;

        return $this;
    }

    /**
     * Get analfabeta
     *
     * @return boolean
     */
    public function getAnalfabeta()
    {
        return $this->analfabeta;
    }

    /**
     * Set fechaNacimiento
     *
     * @param \DateTime $fechaNacimiento
     *
     * @return Paciente
     */
    public function setFechaNacimiento($fechaNacimiento)
    {
        $this->fechaNacimiento = $fechaNacimiento;

        return $this;
    }

    /**
     * Get fechaNacimiento
     *
     * @return \DateTime
     */
    public function getFechaNacimiento()
    {
        return $this->fechaNacimiento;
    }

    /**
     * Set procedencia
     *
     * @param string $procedencia
     *
     * @return Paciente
     */
    public function setProcedencia($procedencia)
    {
        $this->procedencia = $procedencia;

        return $this;
    }

    /**
     * Get procedencia
     *
     * @return string
     */
    public function getProcedencia()
    {
        return $this->procedencia;
    }

    /**
     * Set apellidoFamilia
     *
     * @param string $apellidoFamilia
     *
     * @return Paciente
     */
    public function setApellidoFamilia($apellidoFamilia)
    {
        $this->apellidoFamilia = $apellidoFamilia;

        return $this;
    }

    /**
     * Get apellidoFamilia
     *
     * @return string
     */
    public function getApellidoFamilia()
    {
        return $this->apellidoFamilia;
    }

    /**
     * Set cedulaJefeFamilia
     *
     * @param string $cedulaJefeFamilia
     *
     * @return Paciente
     */
    public function setCedulaJefeFamilia($cedulaJefeFamilia)
    {
        $this->cedulaJefeFamilia = $cedulaJefeFamilia;

        return $this;
    }

    /**
     * Get cedulaJefeFamilia
     *
     * @return string
     */
    public function getCedulaJefeFamilia()
    {
        return $this->cedulaJefeFamilia;
    }

    /**
     * Set comunidad
     *
     * @param string $comunidad
     *
     * @return Paciente
     */
    public function setComunidad($comunidad)
    {
        $this->comunidad = $comunidad;

        return $this;
    }

    /**
     * Get comunidad
     *
     * @return string
     */
    public function getComunidad()
    {
        return $this->comunidad;
    }

    /**
     * Set religion
     *
     * @param \AppBundle\Entity\Religion $religion
     *
     * @return Paciente
     */
    public function setReligion(\AppBundle\Entity\Religion $religion = null)
    {
        $this->religion = $religion;

        return $this;
    }

    /**
     * Get religion
     *
     * @return \AppBundle\Entity\Religion
     */
    public function getReligion()
    {
        return $this->religion;
    }

    /**
     * Set pfg
     *
     * @param \AppBundle\Entity\Pfg $pfg
     *
     * @return Paciente
     */
    public function setPfg(\AppBundle\Entity\Pfg $pfg = null)
    {
        $this->pfg = $pfg;

        return $this;
    }

    /**
     * Get pfg
     *
     * @return \AppBundle\Entity\Pfg
     */
    public function getPfg()
    {
        return $this->pfg;
    }

    /**
     * Set etnia
     *
     * @param \AppBundle\Entity\Etnia $etnia
     *
     * @return Paciente
     */
    public function setEtnia(\AppBundle\Entity\Etnia $etnia = null)
    {
        $this->etnia = $etnia;

        return $this;
    }

    /**
     * Get etnia
     *
     * @return \AppBundle\Entity\Etnia
     */
    public function getEtnia()
    {
        return $this->etnia;
    }

    /**
     * Set persona
     *
     * @param \AppBundle\Entity\Persona $persona
     *
     * @return Paciente
     */
    public function setPersona(\AppBundle\Entity\Persona $persona = null)
    {
        $this->persona = $persona;

        return $this;
    }

    /**
     * Get persona
     *
     * @return \AppBundle\Entity\Persona
     */
    public function getPersona()
    {
        return $this->persona;
    }

    /**
     * Add direccion
     *
     * @param \AppBundle\Entity\Direccion $direccion
     *
     * @return Paciente
     */
    public function addDireccion(\AppBundle\Entity\Direccion $direccion)
    {
        $this->direccion[] = $direccion;

        return $this;
    }

    /**
     * Remove direccion
     *
     * @param \AppBundle\Entity\Direccion $direccion
     */
    public function removeDireccion(\AppBundle\Entity\Direccion $direccion)
    {
        $this->direccion->removeElement($direccion);
    }

    /**
     * Get direccion
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Add familiar
     *
     * @param \AppBundle\Entity\Familiar $familiar
     *
     * @return Paciente
     */
    public function addFamiliar(\AppBundle\Entity\Familiar $familiar)
    {
        $this->familiar[] = $familiar;

        return $this;
    }

    /**
     * Remove familiar
     *
     * @param \AppBundle\Entity\Familiar $familiar
     */
    public function removeFamiliar(\AppBundle\Entity\Familiar $familiar)
    {
        $this->familiar->removeElement($familiar);
    }

    /**
     * Get familiar
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFamiliar()
    {
        return $this->familiar;
    }
    
     /**
     * Set fechaActualizacion
     *
     * @param \DateTime $fechaActualizacion
     *
     * @return Persona
     */
    public function setFechaActualizacion($fechaActualizacion)
    {
        $this->fechaActualizacion = $fechaActualizacion;

        return $this;
    }

    /**
     * Get fechaActualizacion
     *
     * @return \DateTime
     */
    public function getFechaActualizacion()
    {
        return $this->fechaActualizacion;
    }

    /**
     * Set fechaRegistro
     *
     * @param \DateTime $fechaRegistro
     *
     * @return Persona
     */
    public function setFechaRegistro($fechaRegistro)
    {
        $this->fechaRegistro = $fechaRegistro;

        return $this;
    }

    /**
     * Get fechaRegistro
     *
     * @return \DateTime
     */
    public function getFechaRegistro()
    {
        return $this->fechaRegistro;
    }
    
    public function __toString() {
        try {
            return (string) $this->getPersona()->getCedula();
        } catch (Exception $e) {
            return get_class($this) . '@' . spl_object_hash($this); 
        }
    }
}

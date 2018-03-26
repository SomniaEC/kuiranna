<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * @ORM\Entity
 * @ORM\Table(name="usuario")
 */
class Usuario extends BaseUser {
	
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $id;
	
	/**
	 * @ORM\Column(type="string", length=10, nullable=false)
	 */
	protected $cedula;
	
	/**
	 * @ORM\Column(type="string", length=50, nullable=true)
	 */
	protected $telefonoConvencional;
	
	/**
	 * @ORM\Column(type="string", length=50, nullable=true)
	 */
	protected $telefonoCelular;
	
	/**
	 * @ORM\Column(type="string", length=80, nullable=true)
	 */
	protected $cargo;
	
	/**
	 * @ORM\Column(type="datetime", nullable=true)
	 */
	protected $fechaInicio;
	
	/**
	 * @ORM\Column(type="datetime", nullable=true)
	 */
	protected $fechaFin;
	
	/**
	 * @ORM\Column(type="string", length=50, nullable=true)
	 */
	protected $estadoActividad;
	
	/**
	 * @ORM\ManyToOne(targetEntity="Junta", cascade={"persist"})
	 * @ORM\JoinColumn(name="junta_id", referencedColumnName="id")
	 */
	protected $junta;
	
	/**
	 * @ORM\Column(type="string", length=50, nullable=true)
	 */
	protected $rol;
	
	// TODO: add direccion
	// protected $direccion;
	
	/**
	 * User constructor.
	 */
	
	public function __construct()
	{
		parent::__construct();
		// your own logic
	}
	

    /**
     * Set cedula
     *
     * @param string $cedula
     *
     * @return Usuario
     */
    public function setCedula($cedula)
    {
        $this->cedula = $cedula;

        return $this;
    }

    /**
     * Get cedula
     *
     * @return string
     */
    public function getCedula()
    {
        return $this->cedula;
    }

    /**
     * Set telefonoConvencional
     *
     * @param string $telefonoConvencional
     *
     * @return Usuario
     */
    public function setTelefonoConvencional($telefonoConvencional)
    {
        $this->telefonoConvencional = $telefonoConvencional;

        return $this;
    }

    /**
     * Get telefonoConvencional
     *
     * @return string
     */
    public function getTelefonoConvencional()
    {
        return $this->telefonoConvencional;
    }

    /**
     * Set telefonoCelular
     *
     * @param string $telefonoCelular
     *
     * @return Usuario
     */
    public function setTelefonoCelular($telefonoCelular)
    {
        $this->telefonoCelular = $telefonoCelular;

        return $this;
    }

    /**
     * Get telefonoCelular
     *
     * @return string
     */
    public function getTelefonoCelular()
    {
        return $this->telefonoCelular;
    }

    /**
     * Set cargo
     *
     * @param string $cargo
     *
     * @return Usuario
     */
    public function setCargo($cargo)
    {
        $this->cargo = $cargo;

        return $this;
    }

    /**
     * Get cargo
     *
     * @return string
     */
    public function getCargo()
    {
        return $this->cargo;
    }

    /**
     * Set fechaInicio
     *
     * @param \DateTime $fechaInicio
     *
     * @return Usuario
     */
    public function setFechaInicio($fechaInicio)
    {
        $this->fechaInicio = $fechaInicio;

        return $this;
    }

    /**
     * Get fechaInicio
     *
     * @return \DateTime
     */
    public function getFechaInicio()
    {
        return $this->fechaInicio;
    }

    /**
     * Set fechaFin
     *
     * @param \DateTime $fechaFin
     *
     * @return Usuario
     */
    public function setFechaFin($fechaFin)
    {
        $this->fechaFin = $fechaFin;

        return $this;
    }

    /**
     * Get fechaFin
     *
     * @return \DateTime
     */
    public function getFechaFin()
    {
        return $this->fechaFin;
    }

    /**
     * Set estadoActividad
     *
     * @param string $estadoActividad
     *
     * @return Usuario
     */
    public function setEstadoActividad($estadoActividad)
    {
        $this->estadoActividad = $estadoActividad;

        return $this;
    }

    /**
     * Get estadoActividadactor
     *
     * @return string
     */
    public function getEstadoActividad()
    {
        return $this->estadoActividad;
    }

    /**
     * Set junta
     *
     * @param \AppBundle\Entity\Junta $junta
     *
     * @return Usuario
     */
    public function setJunta(\AppBundle\Entity\Junta $junta = null)
    {
        $this->junta = $junta;

        return $this;
    }

    /**
     * Get junta
     *
     * @return \AppBundle\Entity\Junta
     */
    public function getJunta()
    {
        return $this->junta;
    }
    
    /**
     * Set rol
     *
     * @param string $rol
     *
     * @return Usuario
     */
    public function setRol($rol)
    {
    	$this->rol = $rol;
    	$this->setRoles(array($rol));
    	return $this;
    }
    
    /**
     * Get rol
     *
     * @return string
     */
    public function getRol()
    {
    	return $this->rol;
    }
    
    public function getMostrarDetalles() {
    	return array (
    			$this->cedula,
    			$this->username,
    	);
    }
    public static function getMostrarCabeceras() {
    	return array (
    			"Cédula",
    			"Username",
    	);
    }
    
    public static function getNombreEntidad() {
    	return "usuario";
    }
}

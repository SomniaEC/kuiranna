<?

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="vulnerado")
 */
class Vulnerado extends EntidadBase {
	/**
	 * @ORM\Column(type="string", length=250)
	 */
	private $nombres;
	/**
	 * @ORM\Column(type="string", length=250)
	 */
	private $nombresPadre;
	/**
	 * @ORM\Column(type="string", length=250)
	 */
	private $nombresMadre;
	/**
	 * @ORM\Column(type="date")
	 */
	private $fechaNacimiento;
	/**
	 * @ORM\Column(type="string", length=10)
	 */
	private $cedula;
	/**
	 * @ORM\Column(type="string", length=100)
	 */
	private $nacionalidad;
	/**
	 * @ORM\Column(type="boolean", length=100)
	 */
	private $tieneCapacidadEspecial;
	/**
	 * @ORM\ManyToOne(targetEntity="CentroEducativo", cascade={"persist"})
	 * @ORM\JoinColumn(name="centroEducativo_id", referencedColumnName="id")
	 */
	private $centroEducativo;
	
	
	public function getMostrarDetalles() {
		return array($this->id, $this->nombres, $this->nacionalidad, $this->cedula, $this->fechaNacimiento->format('d-m-Y'));
	}
	
	public static function getMostrarCabeceras() {
		return array("id", "nombres", "nacionalidad","cedula","fechaNacimiento");
	}
	
	public static function getNombreEntidad() {
		return "vulnerado";
	}
	public function __toString() {
		return $this->nombres;
	}

    /**
     * Set nombres
     *
     * @param string $nombres
     *
     * @return Vulnerado
     */
    public function setNombres($nombres)
    {
        $this->nombres = $nombres;

        return $this;
    }

    /**
     * Get nombres
     *
     * @return string
     */
    public function getNombres()
    {
        return $this->nombres;
    }

    /**
     * Set nombresPadre
     *
     * @param string $nombresPadre
     *
     * @return Vulnerado
     */
    public function setNombresPadre($nombresPadre)
    {
        $this->nombresPadre = $nombresPadre;

        return $this;
    }

    /**
     * Get nombresPadre
     *
     * @return string
     */
    public function getNombresPadre()
    {
        return $this->nombresPadre;
    }

    /**
     * Set nombresMadre
     *
     * @param string $nombresMadre
     *
     * @return Vulnerado
     */
    public function setNombresMadre($nombresMadre)
    {
        $this->nombresMadre = $nombresMadre;

        return $this;
    }

    /**
     * Get nombresMadre
     *
     * @return string
     */
    public function getNombresMadre()
    {
        return $this->nombresMadre;
    }

    /**
     * Set fechaNacimiento
     *
     * @param \DateTime $fechaNacimiento
     *
     * @return Vulnerado
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
     * Set cedula
     *
     * @param string $cedula
     *
     * @return Vulnerado
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
     * Set nacionalidad
     *
     * @param string $nacionalidad
     *
     * @return Vulnerado
     */
    public function setNacionalidad($nacionalidad)
    {
        $this->nacionalidad = $nacionalidad;

        return $this;
    }

    /**
     * Get nacionalidad
     *
     * @return string
     */
    public function getNacionalidad()
    {
        return $this->nacionalidad;
    }

    /**
     * Set centroEducativo
     *
     * @param \AppBundle\Entity\CentroEducativo $centroEducativo
     *
     * @return Vulnerado
     */
    public function setCentroEducativo(\AppBundle\Entity\CentroEducativo $centroEducativo = null)
    {
        $this->centroEducativo = $centroEducativo;

        return $this;
    }

    /**
     * Get centroEducativo
     *
     * @return \AppBundle\Entity\CentroEducativo
     */
    public function getCentroEducativo()
    {
        return $this->centroEducativo;
    }

    /**
     * Set tieneCapacidadEspecial
     *
     * @param boolean $tieneCapacidadEspecial
     *
     * @return Vulnerado
     */
    public function setTieneCapacidadEspecial($tieneCapacidadEspecial)
    {
        $this->tieneCapacidadEspecial = $tieneCapacidadEspecial;

        return $this;
    }

    /**
     * Get tieneCapacidadEspecial
     *
     * @return boolean
     */
    public function getTieneCapacidadEspecial()
    {
        return $this->tieneCapacidadEspecial;
    }
}

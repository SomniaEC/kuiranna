<?

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="personaDomicilio")
 */
class PersonaDomicilio extends EntidadBase {
	/**
	 * @ORM\Column(type="string", length=250)
	 */
	private $tipo;
	/**
	 * @ORM\ManyToOne(targetEntity="Persona", cascade={"persist"})
	 * @ORM\JoinColumn(name="persona_id", referencedColumnName="id")
	 */
	private $persona;
	
	/**
	 * @ORM\ManyToOne(targetEntity="Domicilio", cascade={"persist"})
	 * @ORM\JoinColumn(name="domicilio_id", referencedColumnName="id")
	 */
	private $domicilio;
	
	/**
	 * @ORM\ManyToOne(targetEntity="Denuncia", cascade={"persist"}, inversedBy="personasDomicilio")
	 * @ORM\JoinColumn(name="denuncia_id", referencedColumnName="id")
	 */
	private $denuncia;
	/**
	 * @ORM\ManyToOne(targetEntity="Junta", cascade={"persist"})
	 * @ORM\JoinColumn(name="junta_id", referencedColumnName="id")
	 */
	private $junta;
	
	
	public function getMostrarDetalles() {
		return array($this->id, $this->persona, $this->domicilio, $this->denuncia, $this->tipo);
	}
	
	public static function getMostrarCabeceras() {
		return array("id", "persona", "domicilio","denuncia","tipo");
	}
	
	public static function getNombreEntidad() {
		return "personaDomicilio";
	}
	public function __toString() {
		return $this->nombres;
	}

    /**
     * Set tipo
     *
     * @param string $tipo
     *
     * @return PersonaDomicilio
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return string
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set persona
     *
     * @param \AppBundle\Entity\Persona $persona
     *
     * @return PersonaDomicilio
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
     * Set domicilio
     *
     * @param \AppBundle\Entity\Domicilio $domicilio
     *
     * @return PersonaDomicilio
     */
    public function setDomicilio(\AppBundle\Entity\Domicilio $domicilio = null)
    {
        $this->domicilio = $domicilio;

        return $this;
    }

    /**
     * Get domicilio
     *
     * @return \AppBundle\Entity\Domicilio
     */
    public function getDomicilio()
    {
        return $this->domicilio;
    }

    /**
     * Set denuncia
     *
     * @param \AppBundle\Entity\Denuncia $denuncia
     *
     * @return PersonaDomicilio
     */
    public function setDenuncia(\AppBundle\Entity\Denuncia $denuncia = null)
    {
        $this->denuncia = $denuncia;

        return $this;
    }

    /**
     * Get denuncia
     *
     * @return \AppBundle\Entity\Denuncia
     */
    public function getDenuncia()
    {
        return $this->denuncia;
    }

    /**
     * Set junta
     *
     * @param \AppBundle\Entity\Junta $junta
     *
     * @return PersonaDomicilio
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
}

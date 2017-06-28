<?

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="vulneradoDomicilio")
 */
class VulneradoDomicilio extends EntidadBase {
	/**
	 * @ORM\Column(type="string", length=250)
	 */
	private $viveCon;
	/**
	 * @ORM\ManyToOne(targetEntity="Vulnerado", cascade={"persist"})
	 * @ORM\JoinColumn(name="vulnerado_id", referencedColumnName="id")
	 */
	private $vulnerado;
	
	/**
	 * @ORM\ManyToOne(targetEntity="Domicilio", cascade={"persist"})
	 * @ORM\JoinColumn(name="domicilio_id", referencedColumnName="id")
	 */
	private $domicilio;
	
	/**
	 * @ORM\ManyToOne(targetEntity="Denuncia", cascade={"persist"}, inversedBy="vulneradosDomicilio")
	 * @ORM\JoinColumn(name="denuncia_id", referencedColumnName="id")
	 */
	private $denuncia;
	/**
	 * @ORM\ManyToOne(targetEntity="Junta", cascade={"persist"})
	 * @ORM\JoinColumn(name="junta_id", referencedColumnName="id")
	 */
	private $junta;
	
	
	public function getMostrarDetalles() {
		return array($this->id, $this->vulnerado, $this->domicilio, $this->denuncia, $this->viveCon);
	}
	
	public static function getMostrarCabeceras() {
		return array("id", "vulnerado", "domicilio","denuncia","viveCon");
	}
	
	public static function getNombreEntidad() {
		return "vulneradoDomicilio";
	}
	public function __toString() {
		return $this->nombres;
	}

    /**
     * Set viveCon
     *
     * @param string $viveCon
     *
     * @return VulneradoDomicilio
     */
    public function setViveCon($viveCon)
    {
        $this->viveCon = $viveCon;

        return $this;
    }

    /**
     * Get viveCon
     *
     * @return string
     */
    public function getViveCon()
    {
        return $this->viveCon;
    }

    /**
     * Set vulnerado
     *
     * @param \AppBundle\Entity\Vulnerado $vulnerado
     *
     * @return VulneradoDomicilio
     */
    public function setVulnerado(\AppBundle\Entity\Vulnerado $vulnerado = null)
    {
        $this->vulnerado = $vulnerado;

        return $this;
    }

    /**
     * Get vulnerado
     *
     * @return \AppBundle\Entity\Vulnerado
     */
    public function getVulnerado()
    {
        return $this->vulnerado;
    }

    /**
     * Set domicilio
     *
     * @param \AppBundle\Entity\Domicilio $domicilio
     *
     * @return VulneradoDomicilio
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
     * @return VulneradoDomicilio
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
     * @return VulneradoDomicilio
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

<?

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="denuncia")
 */
class Denuncia extends EntidadBase {
	/**
	 * @ORM\Column(type="date")
	 */
	private $fechaRegistro;
	/**
	 * @ORM\Column(type="string", length=500)
	 */
	private $hechos;
	
	/**
	 * Muchas Denuncias tienen muchos Derechos Vulnerados.
	 * @ORM\ManyToMany(targetEntity="Derecho")
	 * @ORM\JoinTable(name="derechoVulnerado",
	 *      joinColumns={@ORM\JoinColumn(name="denuncia_id", referencedColumnName="id")},
	 *      inverseJoinColumns={@ORM\JoinColumn(name="derecho_id", referencedColumnName="id")}
	 *      )
	 */
	private $derechos;
	
	/**
	 * @ORM\ManyToOne(targetEntity="Junta", cascade={"persist"})
	 * @ORM\JoinColumn(name="junta_id", referencedColumnName="id")
	 */
	private $junta;
	
	/**
	 * @ORM\OneToMany(targetEntity="PersonaDomicilio", mappedBy="denuncia", cascade={"persist"})
	 */
	private $personasDomicilio;
	
	/**
	 * @ORM\OneToMany(targetEntity="VulneradoDomicilio", mappedBy="denuncia", cascade={"persist"})
	 */
	private $vulneradosDomicilio;
	
	
	public function getMostrarDetalles() {
		return array (
				$this->id,
				$this->fechaRegistro->format ( 'd-m-Y' ),
				$this->hechos,
				implode (", ", $this->derechos->getValues()),
				$this->junta
		);
	}
	public static function getMostrarCabeceras() {
		return array (
				"id",
				"fechaRegistro",
				"hechos",
				"derechos",
				"junta"
		);
	}
	public static function getNombreEntidad() {
		return "denuncia";
	}
	public function __toString() {
		return $this->hechos;
	}

    /**
     * Set fechaRegistro
     *
     * @param \DateTime $fechaRegistro
     *
     * @return Denuncia
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

    /**
     * Set hechos
     *
     * @param string $hechos
     *
     * @return Denuncia
     */
    public function setHechos($hechos)
    {
        $this->hechos = $hechos;

        return $this;
    }

    /**
     * Get hechos
     *
     * @return string
     */
    public function getHechos()
    {
        return $this->hechos;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->derechos = new \Doctrine\Common\Collections\ArrayCollection();
        $this->personasDomicilio = new \Doctrine\Common\Collections\ArrayCollection();
        $this->vulneradosDomicilio = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add derecho
     *
     * @param \AppBundle\Entity\Derecho $derecho
     *
     * @return Denuncia
     */
    public function addDerecho(\AppBundle\Entity\Derecho $derecho)
    {
        $this->derechos[] = $derecho;

        return $this;
    }

    /**
     * Remove derecho
     *
     * @param \AppBundle\Entity\Derecho $derecho
     */
    public function removeDerecho(\AppBundle\Entity\Derecho $derecho)
    {
        $this->derechos->removeElement($derecho);
    }

    /**
     * Get derechos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDerechos()
    {
        return $this->derechos;
    }

    /**
     * Set junta
     *
     * @param \AppBundle\Entity\Junta $junta
     *
     * @return Denuncia
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
     * Add personasDomicilio
     *
     * @param \AppBundle\Entity\PersonaDomicilio $personasDomicilio
     *
     * @return Denuncia
     */
    public function addPersonasDomicilio(\AppBundle\Entity\PersonaDomicilio $personasDomicilio)
    {
        $this->personasDomicilio->add($personasDomicilio);

        return $this;
    }

    /**
     * Remove personasDomicilio
     *
     * @param \AppBundle\Entity\PersonaDomicilio $personasDomicilio
     */
    public function removePersonasDomicilio(\AppBundle\Entity\PersonaDomicilio $personasDomicilio)
    {
        $this->personasDomicilio->removeElement($personasDomicilio);
    }

    /**
     * Get personasDomicilio
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPersonasDomicilio()
    {
        return $this->personasDomicilio;
    }

    /**
     * Add vulneradosDomicilio
     *
     * @param \AppBundle\Entity\VulneradoDomicilio $vulneradosDomicilio
     *
     * @return Denuncia
     */
    public function addVulneradosDomicilio(\AppBundle\Entity\VulneradoDomicilio $vulneradosDomicilio)
    {
        $this->vulneradosDomicilio[] = $vulneradosDomicilio;

        return $this;
    }

    /**
     * Remove vulneradosDomicilio
     *
     * @param \AppBundle\Entity\VulneradoDomicilio $vulneradosDomicilio
     */
    public function removeVulneradosDomicilio(\AppBundle\Entity\VulneradoDomicilio $vulneradosDomicilio)
    {
        $this->vulneradosDomicilio->removeElement($vulneradosDomicilio);
    }

    /**
     * Get vulneradosDomicilio
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVulneradosDomicilio()
    {
        return $this->vulneradosDomicilio;
    }
}

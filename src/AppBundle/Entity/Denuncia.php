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
	 * Many Denuncias have Many Derechos Vulnerados.
	 * @ORM\ManyToMany(targetEntity="Derecho")
	 * @ORM\JoinTable(name="derechoVulnerado",
	 *      joinColumns={@ORM\JoinColumn(name="denuncia_id", referencedColumnName="id")},
	 *      inverseJoinColumns={@ORM\JoinColumn(name="derecho_id", referencedColumnName="id")}
	 *      )
	 */
	private $derechos;
	
	
	public function getMostrarDetalles() {
		return array (
				$this->id,
				$this->fechaRegistro->format ( 'd-m-Y' ),
				$this->hechos,
				implode (", ", $this->derechos->getValues())
		);
	}
	public static function getMostrarCabeceras() {
		return array (
				"id",
				"fechaRegistro",
				"hechos",
				"derechos"
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
}

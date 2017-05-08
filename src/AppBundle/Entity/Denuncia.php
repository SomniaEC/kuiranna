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
	
	public function getMostrarDetalles() {
		return array (
				$this->id,
				$this->fechaRegistro->format ( 'd-m-Y' ),
				$this->hechos
		);
	}
	public static function getMostrarCabeceras() {
		return array (
				"id",
				"fechaRegistro",
				"hechos"
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
}

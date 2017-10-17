<?

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="operacionDenuncia")
 */
class OperacionDenuncia extends EntidadBase {
	
	/**
	 * @ORM\Column(type="string", length=45)
	 */
	private $operacion;
	
	/**
	 * @ORM\Column(type="date")
	 */
	private $fechaHora;
	
	/**
	 * @ORM\ManyToOne(targetEntity="Denuncia", cascade={"persist"}, inversedBy="vulneradosDireccion")
	 * @ORM\JoinColumn(name="denuncia_id", referencedColumnName="id")
	 */
	private $denuncia;
	
	/**
	 *
	 * {@inheritdoc}
	 *
	 * @see \AppBundle\Entity\EntidadBase::getMostrarDetalles()
	 */
	public function getMostrarDetalles() {
		return array (
				$this->id,
				$this->operacion,
				$this->fechaHora->format ( 'd-m-Y' ),
				$this->denuncia 
		);
	}
	
	/**
	 *
	 * @return string[]
	 */
	public static function getMostrarCabeceras() {
		return array (
				"id",
				"operacion",
				"fechaHora",
				"denuncia" 
		);
	}
	
	/**
	 *
	 * @return string
	 */
	public static function getNombreEntidad() {
		return "operacionDenuncia";
	}
	
	/**
	 *
	 * {@inheritdoc}
	 * @see \AppBundle\Entity\EntidadBase::__toString()
	 */
	public function __toString() {
		return $this->nombres;
	}
	
	/**
	 *
	 * @return mixed
	 */
	public function getOperacion() {
		return $this->operacion;
	}
	
	/**
	 *
	 * @param mixed $operacion
	 */
	public function setOperacion($operacion) {
		$this->operacion = $operacion;
	}
	
	/**
	 *
	 * @return mixed
	 */
	public function getFechaHora() {
		return $this->fechaHora;
	}
	
	/**
	 *
	 * @param mixed $fechaHora
	 */
	public function setFechaHora($fechaHora) {
		$this->fechaHora = $fechaHora;
	}
	
	/**
	 * Set denuncia
	 *
	 * @param \AppBundle\Entity\Denuncia $denuncia
	 *
	 * @return OperacionDenuncia
	 */
	public function setDenuncia(\AppBundle\Entity\Denuncia $denuncia = null) {
		$this->denuncia = $denuncia;
		
		return $this;
	}
	
	/**
	 * Get denuncia
	 *
	 * @return \AppBundle\Entity\Denuncia
	 */
	public function getDenuncia() {
		return $this->denuncia;
	}
}

<?

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="vulneradoDireccion")
 */
class VulneradoDireccion extends EntidadBase {
	
	/**
	 * @ORM\ManyToOne(targetEntity="Vulnerado", cascade={"persist"})
	 * @ORM\JoinColumn(name="vulnerado_id", referencedColumnName="id")
	 * @Assert\Valid
	 */
	private $vulnerado;
	
	/**
	 * @ORM\ManyToOne(targetEntity="Direccion", cascade={"persist"})
	 * @ORM\JoinColumn(name="direccion_id", referencedColumnName="id")
	 */
	private $direccion;
	
	/**
	 * @ORM\ManyToOne(targetEntity="Denuncia", cascade={"persist"}, inversedBy="vulneradosDireccion")
	 * @ORM\JoinColumn(name="denuncia_id", referencedColumnName="id")
	 */
	private $denuncia;
	
	/**
	 * @ORM\ManyToOne(targetEntity="Junta", cascade={"persist"})
	 * @ORM\JoinColumn(name="junta_id", referencedColumnName="id")
	 */
	private $junta;
	
	/**
	 *
	 * {@inheritdoc}
	 *
	 * @see \AppBundle\Entity\EntidadBase::getMostrarDetalles()
	 */
	public function getMostrarDetalles() {
		return array (
				$this->id,
				$this->vulnerado,
				$this->direccion,
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
				"vulnerado",
				"direccion",
				"denuncia"
		);
	}
	
	/**
	 *
	 * @return string
	 */
	public static function getNombreEntidad() {
		return "vulneradoDireccion";
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\EntidadBase::__toString()
	 */
	public function __toString() {
		return $this->vulnerado . " " . $this->direccion;
	}
	
	/**
	 * Set vulnerado
	 *
	 * @param \AppBundle\Entity\Vulnerado $vulnerado        	
	 *
	 * @return VulneradoDireccion
	 */
	public function setVulnerado(\AppBundle\Entity\Vulnerado $vulnerado = null) {
		$this->vulnerado = $vulnerado;
		
		return $this;
	}
	
	/**
	 * Get vulnerado
	 *
	 * @return \AppBundle\Entity\Vulnerado
	 */
	public function getVulnerado() {
		return $this->vulnerado;
	}
	
	/**
	 * Set direccion
	 *
	 * @param \AppBundle\Entity\Direccion $direccion        	
	 *
	 * @return VulneradoDireccion
	 */
	public function setDireccion(\AppBundle\Entity\Direccion $direccion = null) {
		$this->direccion = $direccion;
		
		return $this;
	}
	
	/**
	 * Get direccion
	 *
	 * @return \AppBundle\Entity\Direccion
	 */
	public function getDireccion() {
		return $this->direccion;
	}
	
	/**
	 * Set denuncia
	 *
	 * @param \AppBundle\Entity\Denuncia $denuncia        	
	 *
	 * @return VulneradoDireccion
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
	
	/**
	 * Set junta
	 *
	 * @param \AppBundle\Entity\Junta $junta        	
	 *
	 * @return VulneradoDireccion
	 */
	public function setJunta(\AppBundle\Entity\Junta $junta = null) {
		$this->junta = $junta;
		
		return $this;
	}
	
	/**
	 * Get junta
	 *
	 * @return \AppBundle\Entity\Junta
	 */
	public function getJunta() {
		return $this->junta;
	}
}

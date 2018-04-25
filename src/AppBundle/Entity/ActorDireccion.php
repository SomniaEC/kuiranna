<?

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="actorDireccion")
 */
class ActorDireccion extends EntidadBase {
	
	/**
	 * @ORM\Column(type="string", length=45, nullable=true)
	 */
	private $rol;
	
	/**
	 * @ORM\ManyToOne(targetEntity="Actor", cascade={"persist", "remove"})
	 * @ORM\JoinColumn(name="actor_id", referencedColumnName="id")
	 * @Assert\Valid
	 */
	private $actor;
	
	/**
	 * @ORM\ManyToOne(targetEntity="Direccion", cascade={"persist", "remove"})
	 * @ORM\JoinColumn(name="direccion_id", referencedColumnName="id")
	 */
	private $direccion;
	
	/**
	 * @ORM\ManyToOne(targetEntity="Direccion", cascade={"persist", "remove"})
	 * @ORM\JoinColumn(name="direccion_trabajo_id", referencedColumnName="id")
	 */
	private $direccionTrabajo;
	
	/**
	 * @ORM\ManyToOne(targetEntity="Denuncia", cascade={"persist", "remove"}, inversedBy="actoresDireccion")
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
				$this->rol,
				$this->actor,
				$this->direccion,
				$this->direccionTrabajo,
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
				"rol",
				"actor",
				"direccion",
				"direccion de trabajo",
				"denuncia"
		);
	}
	
	/**
	 *
	 * @return string
	 */
	public static function getNombreEntidad() {
		return "actorDireccion";
	}
	
	/**
	 *
	 * {@inheritdoc}
	 *
	 * @see \AppBundle\Entity\EntidadBase::__toString()
	 */
	public function __toString() {
		return $this->actor . " " . $this->direccion;
	}
	
	/**
	 * Set rol
	 *
	 * @param string $rol        	
	 *
	 * @return ActorDireccion
	 */
	public function setRol($rol) {
		$this->rol = $rol;
		
		return $this;
	}
	
	/**
	 * Get rol
	 *
	 * @return string
	 */
	public function getRol() {
		return $this->rol;
	}
	
	/**
	 * Set actor
	 *
	 * @param \AppBundle\Entity\Actor $actor        	
	 *
	 * @return ActorDireccion
	 */
	public function setActor(\AppBundle\Entity\Actor $actor = null) {
		$this->actor = $actor;
		
		return $this;
	}
	
	/**
	 * Get actor
	 *
	 * @return \AppBundle\Entity\Actor
	 */
	public function getActor() {
		return $this->actor;
	}
	
	/**
	 * Set direccion
	 *
	 * @param \AppBundle\Entity\Direccion $direccion        	
	 *
	 * @return ActorDireccion
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
	 * @return mixed
	 */
	public function getDireccionTrabajo() {
		return $this->direccionTrabajo;
	}

	/**
	 * @param mixed $direccionTrabajo
	 */
	public function setDireccionTrabajo($direccionTrabajo) {
		$this->direccionTrabajo = $direccionTrabajo;
	}

	/**
	 * Set denuncia
	 *
	 * @param \AppBundle\Entity\Denuncia $denuncia        	
	 *
	 * @return ActorDireccion
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
	 * @return ActorDireccion
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

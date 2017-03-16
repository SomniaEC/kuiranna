<?

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="persona")
 */
class Persona extends EntidadBase {
	/**
	 * @ORM\Column(type="string", length=250)
	 */
	private $nombres;
	
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
	 * @ORM\Column(type="string", length=100)
	 */
	private $telefono;
	/**
	 * @ORM\Column(type="string", length=100)
	 * @Assert\Email(
	 * message = "El email '{{ value }}' no es válido."
	 * )
	 */
	private $email;
	
	/**
	 * Set nombres
	 *
	 * @param string $nombres        	
	 *
	 * @return Persona
	 */
	public function setNombres($nombres) {
		$this->nombres = $nombres;
		
		return $this;
	}
	
	/**
	 * Get nombres
	 *
	 * @return string
	 */
	public function getNombres() {
		return $this->nombres;
	}
	
	/**
	 * Set fechaNacimiento
	 *
	 * @param \DateTime $fechaNacimiento        	
	 *
	 * @return Persona
	 */
	public function setFechaNacimiento($fechaNacimiento) {
		$this->fechaNacimiento = $fechaNacimiento;
		
		return $this;
	}
	
	/**
	 * Get fechaNacimiento
	 *
	 * @return \DateTime
	 */
	public function getFechaNacimiento() {
		return $this->fechaNacimiento;
	}
	
	/**
	 * Set cedula
	 *
	 * @param string $cedula        	
	 *
	 * @return Persona
	 */
	public function setCedula($cedula) {
		$this->cedula = $cedula;
		
		return $this;
	}
	
	/**
	 * Get cedula
	 *
	 * @return string
	 */
	public function getCedula() {
		return $this->cedula;
	}
	
	/**
	 * Set nacionalidad
	 *
	 * @param string $nacionalidad        	
	 *
	 * @return Persona
	 */
	public function setNacionalidad($nacionalidad) {
		$this->nacionalidad = $nacionalidad;
		
		return $this;
	}
	
	/**
	 * Get nacionalidad
	 *
	 * @return string
	 */
	public function getNacionalidad() {
		return $this->nacionalidad;
	}
	
	/**
	 * Set telefono
	 *
	 * @param string $telefono        	
	 *
	 * @return Persona
	 */
	public function setTelefono($telefono) {
		$this->telefono = $telefono;
		
		return $this;
	}
	
	/**
	 * Get telefono
	 *
	 * @return string
	 */
	public function getTelefono() {
		return $this->telefono;
	}
	
	/**
	 * Set email
	 *
	 * @param string $email        	
	 *
	 * @return Persona
	 */
	public function setEmail($email) {
		$this->email = $email;
		
		return $this;
	}
	
	/**
	 * Get email
	 *
	 * @return string
	 */
	public function getEmail() {
		return $this->email;
	}
	
	/**
	 * Get id
	 *
	 * @return integer
	 */
	public function getId() {
		return $this->id;
	}
	public function getMostrarDetalles() {
		return array($this->id, $this->nombres, $this->nacionalidad, $this->cedula, $this->fechaNacimiento->format('d-m-Y'));
	}
	public function getMostrarCabeceras() {
		return array("id", "nombres", "nacionalidad","cedula","fechaNacimiento");
	}
}

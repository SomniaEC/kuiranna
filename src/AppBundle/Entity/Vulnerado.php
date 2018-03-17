<?

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="vulnerado")
 */
class Vulnerado extends EntidadBase {
	
	/**
	 * @ORM\Column(type="string", length=13, nullable=true)
	 */
	private $identificacion;
	
	/**
	 * @ORM\Column(type="string", length=150, nullable=true)
	 */
	private $nombres;
	
	/**
	 * @ORM\Column(type="date", nullable=true)
	 */
	private $fechaNacimiento;
	
	/**
	 * @ORM\Column(type="string", length=10, nullable=true)
	 */
	private $sexo;
	
	/**
	 * @ORM\Column(type="string", length=10, nullable=true)
	 */
	private $genero;
	
	/**
	 * @ORM\Column(type="string", length=80, nullable=true)
	 */
	private $nacionalidad;
	
	/**
	 * @ORM\Column(type="string", length=20, nullable=true)
	 */
	private $interculturalidad;
	
	/**
	 * @ORM\Column(type="string", length=25, nullable=true)
	 */
	private $ocupacion;
	
	/**
	 * @ORM\Column(type="string", length=25, nullable=true)
	 */
	private $instruccion;
	
	/**
	 * @ORM\Column(type="boolean", nullable=true)
	 */
	private $capacidadEspecial;
	
	/**
	 * @ORM\Column(type="string", length=20, nullable=true)
	 */
	private $legalidad;
	
	/**
	 * @ORM\Column(type="string", length=100, nullable=true)
	 */
	private $telefono;
	
	/**
	 * @ORM\Column(type="string", length=100, nullable=true)
	 * @Assert\Email(message = "El email '{{ value }}' no es valido.")
	 */
	private $email;
	
	/**
	 * @ORM\ManyToOne(targetEntity="CentroEducativo", cascade={"persist"})
	 * @ORM\JoinColumn(name="centroEducativo_id", referencedColumnName="id")
	 */
	private $centroEducativo;
	
	public function getMostrarDetalles() {
		return array (
				$this->id,
				$this->identificacion,
				$this->nombres,
				$this->fechaNacimiento == null ? '' : $this->fechaNacimiento->format ( 'd-m-Y' ),
				$this->sexo,
				$this->genero,
				$this->nacionalidad,
				$this->interculturalidad,
				$this->ocupacion,
				$this->instruccion,
				$this->capacidadEspecial,
				$this->legalidad,
				$this->telefono,
				$this->email,
				$this->centroEducativo
		);
	}
	public static function getMostrarCabeceras() {
		return array (
				"id",
				"identificacion",
				"nombres",
				"fecha de nacimiento",
				"sexo",
				"genero",
				"nacionalidad",
				"interculturalidad",
				"ocupacion",
				"instruccion",
				"capacidad especial",
				"legalidad",
				"telefono",
				"email",
				"centro educativo"
		);
	}
	
	/**
	 *
	 * @return string
	 */
	public static function getNombreEntidad() {
		return "vulnerado";
	}
	
	/**
	 *
	 * {@inheritdoc}
	 *
	 * @see \AppBundle\Entity\EntidadBase::__toString()
	 */
	public function __toString() {
		return $this->nombres == null ? "" : $this->nombres;
	}
	/**
	 * @return mixed
	 */
	public function getIdentificacion() {
		return $this->identificacion;
	}

	/**
	 * @param mixed $identificacion
	 */
	public function setIdentificacion($identificacion) {
		$this->identificacion = $identificacion;
	}

	/**
	 * @return mixed
	 */
	public function getNombres() {
		return $this->nombres;
	}

	/**
	 * @param mixed $nombres
	 */
	public function setNombres($nombres) {
		$this->nombres = $nombres;
	}

	/**
	 * @return mixed
	 */
	public function getFechaNacimiento() {
		return $this->fechaNacimiento;
	}

	/**
	 * @param mixed $fechaNacimiento
	 */
	public function setFechaNacimiento($fechaNacimiento) {
		$this->fechaNacimiento = $fechaNacimiento;
	}

	/**
	 * @return mixed
	 */
	public function getSexo() {
		return $this->sexo;
	}

	/**
	 * @param mixed $sexo
	 */
	public function setSexo($sexo) {
		$this->sexo = $sexo;
	}

	/**
	 * @return mixed
	 */
	public function getGenero() {
		return $this->genero;
	}

	/**
	 * @param mixed $genero
	 */
	public function setGenero($genero) {
		$this->genero = $genero;
	}

	/**
	 * @return mixed
	 */
	public function getNacionalidad() {
		return $this->nacionalidad;
	}

	/**
	 * @param mixed $nacionalidad
	 */
	public function setNacionalidad($nacionalidad) {
		$this->nacionalidad = $nacionalidad;
	}

	/**
	 * @return mixed
	 */
	public function getInterculturalidad() {
		return $this->interculturalidad;
	}

	/**
	 * @param mixed $interculturalidad
	 */
	public function setInterculturalidad($interculturalidad) {
		$this->interculturalidad = $interculturalidad;
	}

	/**
	 * @return mixed
	 */
	public function getOcupacion() {
		return $this->ocupacion;
	}

	/**
	 * @param mixed $ocupacion
	 */
	public function setOcupacion($ocupacion) {
		$this->ocupacion = $ocupacion;
	}

	/**
	 * @return mixed
	 */
	public function getInstruccion() {
		return $this->instruccion;
	}

	/**
	 * @param mixed $instruccion
	 */
	public function setInstruccion($instruccion) {
		$this->instruccion = $instruccion;
	}

	/**
	 * @return mixed
	 */
	public function getCapacidadEspecial() {
		return $this->capacidadEspecial;
	}

	/**
	 * @param mixed $capacidadEspecial
	 */
	public function setCapacidadEspecial($capacidadEspecial) {
		$this->capacidadEspecial = $capacidadEspecial;
	}

	/**
	 * @return mixed
	 */
	public function getLegalidad() {
		return $this->legalidad;
	}

	/**
	 * @param mixed $legalidad
	 */
	public function setLegalidad($legalidad) {
		$this->legalidad = $legalidad;
	}

	/**
	 * @return mixed
	 */
	public function getTelefono() {
		return $this->telefono;
	}

	/**
	 * @param mixed $telefono
	 */
	public function setTelefono($telefono) {
		$this->telefono = $telefono;
	}

	/**
	 * @return mixed
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * @param mixed $email
	 */
	public function setEmail($email) {
		$this->email = $email;
	}

	/**
	 * @return mixed
	 */
	public function getCentroEducativo() {
		return $this->centroEducativo;
	}

	/**
	 * @param mixed $centroEducativo
	 */
	public function setCentroEducativo($centroEducativo) {
		$this->centroEducativo = $centroEducativo;
	}
}

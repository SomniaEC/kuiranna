<?

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use AppBundle\Utils\ConstantesDeTipoActor;

/**
 * @ORM\Entity
 * @ORM\Table(name="actor")
 */
class Actor extends EntidadBase {
	
	/**
	 * @ORM\Column(type="string", length=13, nullable=true)
     * @Assert\Regex(
     *     pattern="/^[0-9]*$/",
     *     message="Cedula/RUC debe contener numeros solamente"
     * )
	 */
	private $identificacion;
	
	/**
	 * @ORM\Column(type="string", length=150, nullable=true)
	 */
	private $nombres;
	
	/**
	 * @ORM\Column(type="string", length=100, nullable=true)
     * @Assert\Regex(
     *     pattern="/^[0-9]*$/",
     *     message="Telefono debe contener numeros solamente"
     * )
     * @Assert\Length(
     *      min = 6,
     *      max = 10,
     *      minMessage = "Telefono debe tener al menos {{ limit }} digitos",
     *      maxMessage = "Telefono no puede tener mas de {{ limit }} digitos"
     * )
	 */
	private $telefono;
	
	/**
	 * @ORM\Column(type="string", length=100, nullable=true)
	 * @Assert\Email(message = "El email '{{ value }}' no es valido.")
	 */
	private $email;
	
	/**
	 * @ORM\Column(type="string", length=13, nullable=true)
     * @Assert\Regex(
     *     pattern="/^[0-9]*$/",
     *     message="Cedula debe contener numeros solamente"
     * )
     * @Assert\Length(
     *      min = 10,
     *      max = 10,
     *      exactMessage = "Cedula debe tener {{ limit }} digitos"
     * )
	 */
	private $identificacionContacto;
	
	/**
	 * @ORM\Column(type="string", length=150, nullable=true)
	 */
	private $nombresContacto;
	
	/**
	 * @ORM\Column(type="string", length=80, nullable=true)
	 */
	private $cargoContacto;
	
	/**
	 * @ORM\Column(type="string", length=100, nullable=true)
	 * @Assert\Email(message = "El email '{{ value }}' no es valido.")
	 */
	private $emailContacto;
	
	/**
	 * @ORM\Column(type="string", length=100, nullable=true)
     * @Assert\Regex(
     *     pattern="/^[0-9]*$/",
     *     message="Telefono de contacto debe contener numeros solamente"
     * )
     * @Assert\Length(
     *      min = 6,
     *      max = 10,
     *      minMessage = "Telefono debe tener al menos {{ limit }} digitos",
     *      maxMessage = "Telefono no puede tener mas de {{ limit }} digitos"
     * )
	 */
	private $telefonoContacto;
	
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
	 * @ORM\ManyToOne(targetEntity="ActividadEconomica", cascade={"persist"})
	 * @ORM\JoinColumn(name="actividadEconomica_id", referencedColumnName="id")
	 */
	private $actividadEconomica;
	
	/**
	 * @ORM\Column(type="string", length=100, nullable=true)
	 */
	private $lugarTrabajo;
	
	/**
	 * @ORM\Column(type="string", length=100, nullable=true)
	 */
	private $instruccion;
	
	/**
	 * @ORM\Column(type="boolean", nullable=true)
	 */
	private $capacidadEspecial;
	
	/**
	 * @ORM\Column(type="string", length=60, nullable=true)
	 */
	private $relacion;
	
	/**
	 * @Assert\Callback
	 */
	public function validate(ExecutionContextInterface $context, $payload) {
		//validacion identificacion persona > cedula, entidad > ruc
		$longitud = strlen($this->identificacion);
		if ($this->tipo == ConstantesDeTipoActor::Persona) {
			if($longitud != 10 && $longitud != 0) {
				$context->buildViolation("Cedula debe tener 10 numeros")
				->atPath('identificacion')
				->addViolation();
			}
		} else {
			if($longitud != 13 && $longitud != 0) {
				$context->buildViolation("RUC debe tener 13 numeros")
				->atPath('identificacion')
				->addViolation();
			}
		}
	}
	
	/**
	 * @ORM\Column(type="string", length=30, nullable=true)
	 */
	private $tipo;
	public function getMostrarDetalles() {
		return array (
				$this->id,
				$this->tipo,
				$this->identificacion,
				$this->nombres,
				$this->telefono,
				$this->email,
				$this->identificacionContacto,
				$this->nombresContacto,
				$this->cargoContacto,
				$this->emailContacto,
				$this->telefonoContacto,
				$this->fechaNacimiento == null ? '' : $this->fechaNacimiento->format ( 'd-m-Y' ),
				$this->sexo,
				$this->genero,
				$this->nacionalidad,
				$this->interculturalidad,
				$this->actividadEconomica,
				$this->lugarTrabajo,
				$this->instruccion,
				$this->capacidadEspecial,
				$this->relacion 
		);
	}
	public static function getMostrarCabeceras() {
		return array (
				"id",
				"tipo",
				"identificacion",
				"nombres",
				"telefono",
				"email",
				"identificacion del contacto",
				"nombres del contacto",
				"cargo del contacto",
				"email del contacto",
				"telefono del contacto",
				"fecha de nacimiento",
				"sexo",
				"genero",
				"nacionalidad",
				"interculturalidad",
				"actividad economica",
				"lugarTrabajo",
				"instruccion",
				"capacidad especial",
				"relacion" 
		);
	}
	public static function getNombreEntidad() {
		return "actor";
	}
	
	public function __toString() {
		return $this->nombres == null ? "" : $this->nombres;
	}
	
	/**
	 *
	 * @return mixed
	 */
	public function getIdentificacion() {
		return $this->identificacion;
	}
	
	/**
	 *
	 * @param mixed $identificacion
	 */
	public function setIdentificacion($identificacion) {
		$this->identificacion = $identificacion;
	}
	
	/**
	 *
	 * @return mixed
	 */
	public function getNombres() {
		return $this->nombres;
	}
	
	/**
	 *
	 * @param mixed $nombres
	 */
	public function setNombres($nombres) {
		$this->nombres = $nombres;
	}
	
	/**
	 *
	 * @return mixed
	 */
	public function getTelefono() {
		return $this->telefono;
	}
	
	/**
	 *
	 * @param mixed $telefono
	 */
	public function setTelefono($telefono) {
		$this->telefono = $telefono;
	}
	
	/**
	 *
	 * @return mixed
	 */
	public function getEmail() {
		return $this->email;
	}
	
	/**
	 *
	 * @param mixed $email
	 */
	public function setEmail($email) {
		$this->email = $email;
	}
	
	/**
	 *
	 * @return mixed
	 */
	public function getIdentificacionContacto() {
		return $this->identificacionContacto;
	}
	
	/**
	 *
	 * @param mixed $identificacionContacto
	 */
	public function setIdentificacionContacto($identificacionContacto) {
		$this->identificacionContacto = $identificacionContacto;
	}
	
	/**
	 *
	 * @return mixed
	 */
	public function getNombresContacto() {
		return $this->nombresContacto;
	}
	
	/**
	 *
	 * @param mixed $nombresContacto
	 */
	public function setNombresContacto($nombresContacto) {
		$this->nombresContacto = $nombresContacto;
	}
	
	/**
	 *
	 * @return mixed
	 */
	public function getCargoContacto() {
		return $this->cargoContacto;
	}
	
	/**
	 *
	 * @param mixed $cargoContacto
	 */
	public function setCargoContacto($cargoContacto) {
		$this->cargoContacto = $cargoContacto;
	}
	
	/**
	 *
	 * @return mixed
	 */
	public function getEmailContacto() {
		return $this->emailContacto;
	}
	
	/**
	 *
	 * @param mixed $emailContacto
	 */
	public function setEmailContacto($emailContacto) {
		$this->emailContacto = $emailContacto;
	}
	
	/**
	 *
	 * @return mixed
	 */
	public function getTelefonoContacto() {
		return $this->telefonoContacto;
	}
	
	/**
	 *
	 * @param mixed $telefonoContacto
	 */
	public function setTelefonoContacto($telefonoContacto) {
		$this->telefonoContacto = $telefonoContacto;
	}
	
	/**
	 *
	 * @return mixed
	 */
	public function getFechaNacimiento() {
		return $this->fechaNacimiento;
	}
	
	/**
	 *
	 * @param mixed $fechaNacimiento
	 */
	public function setFechaNacimiento($fechaNacimiento) {
		$this->fechaNacimiento = $fechaNacimiento;
	}
	
	/**
	 *
	 * @return mixed
	 */
	public function getSexo() {
		return $this->sexo;
	}
	
	/**
	 *
	 * @param mixed $sexo
	 */
	public function setSexo($sexo) {
		$this->sexo = $sexo;
	}
	
	/**
	 *
	 * @return mixed
	 */
	public function getGenero() {
		return $this->genero;
	}
	
	/**
	 *
	 * @param mixed $genero
	 */
	public function setGenero($genero) {
		$this->genero = $genero;
	}
	
	/**
	 *
	 * @return mixed
	 */
	public function getNacionalidad() {
		return $this->nacionalidad;
	}
	
	/**
	 *
	 * @param mixed $nacionalidad
	 */
	public function setNacionalidad($nacionalidad) {
		$this->nacionalidad = $nacionalidad;
	}
	
	/**
	 *
	 * @return mixed
	 */
	public function getInterculturalidad() {
		return $this->interculturalidad;
	}
	
	/**
	 *
	 * @param mixed $interculturalidad
	 */
	public function setInterculturalidad($interculturalidad) {
		$this->interculturalidad = $interculturalidad;
	}
	
	/**
	 *
	 * @return mixed
	 */
	public function getActividadEconomica() {
		return $this->actividadEconomica;
	}
	
	/**
	 *
	 * @param mixed $actividadEconomica
	 */
	public function setActividadEconomica($actividadEconomica) {
		$this->actividadEconomica = $actividadEconomica;
	}
	
	/**
	 *
	 * @return mixed
	 */
	public function getLugarTrabajo() {
		return $this->lugarTrabajo;
	}
	
	/**
	 *
	 * @param mixed $lugarTrabajo
	 */
	public function setLugarTrabajo($lugarTrabajo) {
		$this->lugarTrabajo = $lugarTrabajo;
	}
	
	/**
	 *
	 * @return mixed
	 */
	public function getInstruccion() {
		return $this->instruccion;
	}
	
	/**
	 *
	 * @param mixed $instruccion
	 */
	public function setInstruccion($instruccion) {
		$this->instruccion = $instruccion;
	}
	
	/**
	 *
	 * @return mixed
	 */
	public function getCapacidadEspecial() {
		return $this->capacidadEspecial;
	}
	
	/**
	 *
	 * @param mixed $capacidadEspecial
	 */
	public function setCapacidadEspecial($capacidadEspecial) {
		$this->capacidadEspecial = $capacidadEspecial;
	}
	
	/**
	 *
	 * @return mixed
	 */
	public function getRelacion() {
		return $this->relacion;
	}
	
	/**
	 *
	 * @param mixed $relacion
	 */
	public function setRelacion($relacion) {
		$this->relacion = $relacion;
	}
	
	/**
	 *
	 * @return mixed
	 */
	public function getTipo() {
		return $this->tipo;
	}
	
	/**
	 *
	 * @param mixed $tipo
	 */
	public function setTipo($tipo) {
		$this->tipo = $tipo;
	}
}

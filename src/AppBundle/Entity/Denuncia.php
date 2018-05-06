<?

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Utils\ConstantesDeEstadoDenuncia;

/**
 * @ORM\Entity
 * @ORM\Table(name="denuncia")
 */
class Denuncia extends EntidadBase {
	
	/**
	 * @ORM\Column(type="string", length=20, nullable=false)
	 */
	private $numeroCaso;
	
	/**
	 * @ORM\Column(type="datetime")
	 */
	private $creacion;
	
	/**
	 * @ORM\Column(type="string", length=500, nullable=true)
	 */
	private $hechos;
	
	/**
	 * @ORM\Column(type="string", length=15, nullable=true)
	 */
	private $recursoImpugnacion;
	
	/**
	 * @ORM\Column(type="string", length=30, nullable=true)
	 */
	private $tipoMaltrato;
	
	/**
	 * @ORM\Column(type="string", length=30, nullable=true)
	 */
	private $ambitoMaltrato;
	
	/**
	 * Vulneradores de derechos separados por punto y coma
	 *
	 * @ORM\Column(type="string", length=300, nullable=true)
	 */
	private $vulneradoresDerechos;
	
	private $fechaExpira;
	
	/**
	 * Muchas Denuncias tienen muchos Derechos que han sido vulnerados.
	 * @ORM\ManyToMany(targetEntity="Derecho", cascade={"persist"})
	 * @ORM\JoinTable(name="derechoVulnerado",
	 * joinColumns={@ORM\JoinColumn(name="denuncia_id", referencedColumnName="id")},
	 * inverseJoinColumns={@ORM\JoinColumn(name="derecho_id", referencedColumnName="id")}
	 * )
	 */
	private $derechos;
	
	/**
	 * @ORM\ManyToOne(targetEntity="Junta", cascade={"persist"})
	 * @ORM\JoinColumn(name="junta_id", referencedColumnName="id")
	 */
	private $junta;
	
	/**
	 * @ORM\OneToMany(targetEntity="ActorDireccion", mappedBy="denuncia", cascade={"persist", "remove"})
	 * @Assert\Valid
	 */
	private $actoresDireccion;
	
	/**
	 * @ORM\OneToMany(targetEntity="VulneradoDireccion", mappedBy="denuncia", cascade={"persist", "remove"})
	 * @Assert\Valid
	 */
	private $vulneradosDireccion;
	
	/**
	 * @ORM\OneToMany(targetEntity="OperacionDenuncia", mappedBy="denuncia", cascade={"persist", "remove"})
	 */
	private $operacionesDenuncia;
	
	/**
	 * @ORM\ManyToOne(targetEntity="Usuario")
	 */
	private $responsable;
	
	/**
	 * @ORM\Column(type="datetime", nullable=true)
	 */
	private $fechaAudiencia;
	
	/**
	 * @ORM\Column(type="string", length=500, nullable=true)
	 */
	private $observaciones;
	
	/**
	 * @ORM\Column(type="string", length=30)
	 */
	protected $estadoOperacion = ConstantesDeEstadoDenuncia::Validar;
	
	/**
	 *
	 * {@inheritdoc}
	 *
	 * @see \AppBundle\Entity\EntidadBase::getMostrarDetalles()
	 */
	public function getMostrarDetalles() {
		return array (
				$this->id,
				$this->numeroCaso,
				$this->creacion->format ( 'd/m/Y' ),
				$this->hechos,
				$this->recursoImpugnacion,
				$this->vulneradoresDerechos,
				implode ( ", ", $this->derechos->getValues () ),
				$this->junta,
				$this->estado,
				$this->estadoOperacion
		);
	}
	
	/**
	 *
	 * @return string[]
	 */
	public static function getMostrarCabeceras() {
		return array (
				"id",
				"numero de caso",
				"fecha de registro",
				"hechos",
				"recurso de impugnacion",
				"vulneradores de los derechos",
				"derechos vulnerados",
				"junta",
				"estado",
				"estado de operacion"
		);
	}
	
	/**
	 *
	 * @return string
	 */
	public static function getNombreEntidad() {
		return "denuncia";
	}
	
	/**
	 *
	 * {@inheritdoc}
	 *
	 * @see \AppBundle\Entity\EntidadBase::__toString()
	 */
	public function __toString() {
		return $this->hechos == null ? "" : $this->hechos;
	}
	
	/**
	 * @return mixed
	 */
	public function getNumeroCaso() {
		return $this->numeroCaso;
	}

	/**
	 * @param mixed $numeroCaso
	 */
	public function setNumeroCaso($numeroCaso) {
		$this->numeroCaso = $numeroCaso;
	}

	/**
	 * Set creacion
	 *
	 * @param \DateTime $creacion
	 *
	 * @return Denuncia
	 */
	public function setCreacion($creacion) {
		$this->creacion = $creacion;
		
		return $this;
	}
	
	/**
	 * Get creacion
	 *
	 * @return \DateTime
	 */
	public function getCreacion() {
		return $this->creacion;
	}
	
	/**
	 * Set hechos
	 *
	 * @param string $hechos
	 *
	 * @return Denuncia
	 */
	public function setHechos($hechos) {
		$this->hechos = $hechos;
		
		return $this;
	}
	
	/**
	 * Get hechos
	 *
	 * @return string
	 */
	public function getHechos() {
		return $this->hechos;
	}
	
	/**
	 *
	 * @return mixed
	 */
	public function getRecursoImpugnacion() {
		return $this->recursoImpugnacion;
	}
	
	/**
	 *
	 * @param mixed $recursoImpugnacion
	 */
	public function setRecursoImpugnacion($recursoImpugnacion) {
		$this->recursoImpugnacion = $recursoImpugnacion;
	}
	
	/**
	 *
	 * @return mixed
	 */
	public function getTipoMaltrato() {
		return $this->tipoMaltrato;
	}
	
	/**
	 *
	 * @param mixed $tipoMaltrato
	 */
	public function setTipoMaltrato($tipoMaltrato) {
		$this->tipoMaltrato = $tipoMaltrato;
	}
	
	/**
	 *
	 * @return mixed
	 */
	public function getAmbitoMaltrato() {
		return $this->ambitoMaltrato;
	}
	
	/**
	 *
	 * @param mixed $ambitoMaltrato
	 */
	public function setAmbitoMaltrato($ambitoMaltrato) {
		$this->ambitoMaltrato = $ambitoMaltrato;
	}
	
	/**
	 *
	 * @return mixed
	 */
	public function getVulneradoresDerechos() {
		return explode(';', $this->vulneradoresDerechos);
	}
	
	/**
	 *
	 * @param mixed $vulneradoresDerechos
	 */
	public function setVulneradoresDerechos($vulneradoresDerechos) {
		$this->vulneradoresDerechos = implode(';',$vulneradoresDerechos);
	}
	
	/**
	 * Constructor
	 */
	public function __construct() {
		$this->derechos = new \Doctrine\Common\Collections\ArrayCollection ();
		$this->actoresDireccion = new \Doctrine\Common\Collections\ArrayCollection ();
		$this->vulneradosDireccion = new \Doctrine\Common\Collections\ArrayCollection ();
		$this->operacionesDenuncia = new \Doctrine\Common\Collections\ArrayCollection ();
	}
	
	/**
	 * Add derecho
	 *
	 * @param \AppBundle\Entity\Derecho $derecho
	 *
	 * @return Denuncia
	 */
	public function addDerecho(\AppBundle\Entity\Derecho $derecho) {
		$this->derechos [] = $derecho;
		
		return $this;
	}
	
	/**
	 * Remove derecho
	 *
	 * @param \AppBundle\Entity\Derecho $derecho
	 */
	public function removeDerecho(\AppBundle\Entity\Derecho $derecho) {
		$this->derechos->removeElement ( $derecho );
	}
	
	/**
	 * Get derechos
	 *
	 * @return \Doctrine\Common\Collections\Collection
	 */
	public function getDerechos() {
		return $this->derechos;
	}
	
	/**
	 * Set junta
	 *
	 * @param \AppBundle\Entity\Junta $junta
	 *
	 * @return Denuncia
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
	
	/**
	 * Add actoresDireccion
	 *
	 * @param \AppBundle\Entity\ActorDireccion $actoresDireccion
	 *
	 * @return Denuncia
	 */
	public function addActoresDireccion(\AppBundle\Entity\ActorDireccion $actoresDireccion) {
		$this->actoresDireccion->add ( $actoresDireccion );
		
		return $this;
	}
	
	/**
	 * Remove actoresDireccion
	 *
	 * @param \AppBundle\Entity\ActorDireccion $actoresDireccion
	 */
	public function removeActoresDireccion(\AppBundle\Entity\ActorDireccion $actoresDireccion) {
		$this->actoresDireccion->removeElement ( $actoresDireccion );
	}
	
	/**
	 * Get actoresDireccion
	 *
	 * @return \Doctrine\Common\Collections\Collection
	 */
	public function getActoresDireccion() {
		return $this->actoresDireccion;
	}
	
	/**
	 * Add vulneradosDireccion
	 *
	 * @param \AppBundle\Entity\VulneradoDireccion $vulneradosDireccion
	 *
	 * @return Denuncia
	 */
	public function addVulneradosDireccion(\AppBundle\Entity\VulneradoDireccion $vulneradosDireccion) {
		$this->vulneradosDireccion [] = $vulneradosDireccion;
		
		return $this;
	}
	
	/**
	 * Remove vulneradosDireccion
	 *
	 * @param \AppBundle\Entity\VulneradoDireccion $vulneradosDireccion
	 */
	public function removeVulneradosDireccion(\AppBundle\Entity\VulneradoDireccion $vulneradosDireccion) {
		$this->vulneradosDireccion->removeElement ( $vulneradosDireccion );
	}
	
	/**
	 * Get vulneradosDireccion
	 *
	 * @return \Doctrine\Common\Collections\Collection
	 */
	public function getVulneradosDireccion() {
		return $this->vulneradosDireccion;
	}
	
	/**
	 * Add operacionesDenuncia
	 *
	 * @param \AppBundle\Entity\OperacionDenuncia $operacionesDenuncia
	 *
	 * @return Denuncia
	 */
	public function addOperacionesDenuncia(\AppBundle\Entity\OperacionDenuncia $operacionesDenuncia) {
		$this->operacionesDenuncia [] = $operacionesDenuncia;
		
		return $this;
	}
	
	/**
	 * Remove operacionesDenuncia
	 *
	 * @param \AppBundle\Entity\OperacionesDenuncia $operacionesDenuncia
	 */
	public function removeOperacionesDenuncia(\AppBundle\Entity\OperacionDenuncia $operacionesDenuncia) {
		$this->operacionesDenuncia->removeElement ( $operacionesDenuncia );
	}
	
	/**
	 *
	 * @return \Doctrine\Common\Collections\ArrayCollection
	 */
	public function getOperacionesDenuncia() {
		return $this->operacionesDenuncia;
	}
	
	/**
	 * @return mixed
	 */
	public function getResponsable() {
		return $this->responsable;
	}

	/**
	 * @param mixed $responsable
	 */
	public function setResponsable($responsable) {
		$this->responsable = $responsable;
	}
	
	/**
	 * @return mixed
	 */
	public function getFechaAudiencia() {
		return $this->fechaAudiencia;
	}

	/**
	 * @param mixed $fechaAudiencia
	 */
	public function setFechaAudiencia($fechaAudiencia) {
		$this->fechaAudiencia = $fechaAudiencia;
	}

	/**
	 * @return mixed
	 */
	public function getObservaciones() {
		return $this->observaciones;
	}

	/**
	 * @param mixed $observaciones
	 */
	public function setObservaciones($observaciones) {
		$this->observaciones = $observaciones;
	}
	
	/**
	 * @return string
	 */
	public function getEstadoOperacion() {
		return $this->estadoOperacion;
	}

	/**
	 * @param string $estadoOperacion
	 */
	public function setEstadoOperacion($estadoOperacion) {
		$this->estadoOperacion = $estadoOperacion;
	}
	
	/**
	 * @return string
	 */
	public function getFechaExpira() {
		return $this->fechaExpira;
	}
	
	/**
	 * @param string $estadoOperacion
	 */
	public function setFechaExpira($fechaExpira) {
		$this->fechaExpira = $fechaExpira;
	}
}

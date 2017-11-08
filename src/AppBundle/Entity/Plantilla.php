<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="plantilla")
 */
class Plantilla extends EntidadBase {
	
	/**
	 * @ORM\Column(type="string", length=45)
	 */
	private $tipo;
	
	/**
	 * @ORM\Column(type="string", length=45)
	 */
	private $nombre;
	
	/**
	 * @ORM\Column(type="binary")
	 */
	private $datos;
	
	/**
	 * @ORM\ManyToOne(targetEntity="Junta", cascade={"persist", "remove"})
	 * @ORM\JoinColumn(name="junta_id", referencedColumnName="id")
	 */
	private $junta;
	
	/**
	 *
	 * {@inheritdoc}
	 * @see \AppBundle\Entity\EntidadBase::getMostrarDetalles()
	 */
	public function getMostrarDetalles() {
		return array (
				$this->id,
				$this->tipo,
				$this->nombre
		);
	}
	
	/**
	 *
	 * @return string[]
	 */
	public static function getMostrarCabeceras() {
		return array (
				"id",
				"tipo",
				"nombre" 
		);
	}
	
	/**
	 *
	 * @return string
	 */
	public static function getNombreEntidad() {
		return "plantilla";
	}
	
	/**
	 *
	 * {@inheritdoc}
	 * @see \AppBundle\Entity\EntidadBase::__toString()
	 */
	public function __toString() {
		return $this->nombre;
	}
	/**
	 * @return mixed
	 */
	public function getTipo() {
		return $this->tipo;
	}

	/**
	 * @param mixed $tipo
	 */
	public function setTipo($tipo) {
		$this->tipo = $tipo;
	}

	/**
	 * @return mixed
	 */
	public function getNombre() {
		return $this->nombre;
	}

	/**
	 * @param mixed $nombre
	 */
	public function setNombre($nombre) {
		$this->nombre = $nombre;
	}

	/**
	 * @return mixed
	 */
	public function getDatos() {
		return $this->datos;
	}

	/**
	 * @param mixed $datos
	 */
	public function setDatos($datos) {
		$this->datos = $datos;
	}

	/**
	 * @return mixed
	 */
	public function getJunta() {
		return $this->junta;
	}

	/**
	 * @param mixed $junta
	 */
	public function setJunta($junta) {
		$this->junta = $junta;
	}
}

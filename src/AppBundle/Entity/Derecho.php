<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="derecho")
 */
class Derecho extends EntidadBase {
	
	/**
	 * @ORM\Column(type="string", length=60)
	 */
	private $tipo;

	/**
	 * @ORM\Column(type="string", length=15)
	 */
	private $nombre;
	
	/**
	 * @ORM\Column(type="string", length=200, nullable=true)
	 */
	private $descripcion;
	
	/**
	 *
	 * {@inheritdoc}
	 *
	 * @see \AppBundle\Entity\EntidadBase::getMostrarDetalles()
	 */
	public function getMostrarDetalles() {
		return array (
				$this->id,
				$this->tipo,
				$this->nombre,
				$this->descripcion
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
				"nombre",
				"descripcion"
		);
	}
	
	/**
	 *
	 * @return string
	 */
	public static function getNombreEntidad() {
		return "derecho";
	}
	
	/**
	 * 
	 * {@inheritDoc}
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
	 * @return mixed
	 */
	public function getNombre() {
		return $this->nombre;
	}

	/**
	 * @return mixed
	 */
	public function getDescripcion() {
		return $this->descripcion;
	}

	/**
	 * @param mixed $tipo
	 */
	public function setTipo($tipo) {
		$this->tipo = $tipo;
	}

	/**
	 * @param mixed $nombre
	 */
	public function setNombre($nombre) {
		$this->nombre = $nombre;
	}

	/**
	 * @param mixed $descripcion
	 */
	public function setDescripcion($descripcion) {
		$this->descripcion = $descripcion;
	}

}

<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="actividadEconomica")
 */
class ActividadEconomica extends EntidadBase {

	/**
	 * @ORM\Column(type="string", length=100)
	 */
	private $nombre;
	
	/**
	 *
	 * {@inheritdoc}
	 *
	 * @see \AppBundle\Entity\EntidadBase::getMostrarDetalles()
	 */
	public function getMostrarDetalles() {
		return array (
				$this->id,
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
				"nombre"
		);
	}
	
	/**
	 *
	 * @return string
	 */
	public static function getNombreEntidad() {
		return "actividadEconomica";
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
	public function getNombre() {
		return $this->nombre;
	}

	/**
	 * @param mixed $nombre
	 */
	public function setNombre($nombre) {
		$this->nombre = $nombre;
	}
}

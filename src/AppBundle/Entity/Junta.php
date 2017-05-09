<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="junta")
 */
class Junta extends EntidadBase {
	
	/**
	 * @ORM\Column(type="string", length=250)
	 */
	private $nombre;
	
	/**
	 * @ORM\ManyToOne(targetEntity="Domicilio", cascade={"persist"})
	 * @ORM\JoinColumn(name="domicilio_id", referencedColumnName="id")
	 */
	private $domicilio;
	
	public function getMostrarDetalles() {
		return array (
				$this->id,
				$this->nombre 
		);
	}
	public static function getMostrarCabeceras() {
		return array (
				"id",
				"nombre" 
		);
	}
	public static function getNombreEntidad() {
		return "junta";
	}
	
	/**
	 * Set nombre
	 *
	 * @param string $nombre        	
	 *
	 * @return Junta
	 */
	public function setNombre($nombre) {
		$this->nombre = $nombre;
		
		return $this;
	}
	
	/**
	 * Get nombre
	 *
	 * @return string
	 */
	public function getNombre() {
		return $this->nombre;
	}
	
	/**
	 * Set domicilio
	 *
	 * @param \AppBundle\Entity\Domicilio $domicilio        	
	 *
	 * @return Junta
	 */
	public function setDomicilio(\AppBundle\Entity\Domicilio $domicilio = null) {
		$this->domicilio = $domicilio;
		
		return $this;
	}
	
	/**
	 * Get domicilio
	 *
	 * @return \AppBundle\Entity\Domicilio
	 */
	public function getDomicilio() {
		return $this->domicilio;
	}
	
	public function __toString() {
		return $this->nombre;
	}
}

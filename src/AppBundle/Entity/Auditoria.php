<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="auditoria")
 */
class Auditoria extends EntidadBase {
	
	/**
	 * @ORM\Column(type="string", length=100)
	 */
	private $modulo;
	
	/**
	 * @ORM\Column(type="string", length=100)
	 */
	private $accion;
	
	/**
	 * @ORM\Column(type="date")
	 */
	private $fechaHora;
	
	/**
	 * @ORM\Column(type="string", length=15)
	 */
	private $ip;
	
	/**
	 *
	 * {@inheritdoc}
	 *
	 * @see \AppBundle\Entity\EntidadBase::getMostrarDetalles()
	 */
	public function getMostrarDetalles() {
		return array (
				$this->id,
				$this->modulo,
				$this->accion,
				$this->fechaHora->format ( 'd-m-Y' ),
				$this->ip 
		);
	}
	
	/**
	 *
	 * @return string[]
	 */
	public static function getMostrarCabeceras() {
		return array (
				"id",
				"modulo",
				"accion",
				"fechaHora",
				"ip" 
		);
	}
	
	/**
	 *
	 * @return string
	 */
	public static function getNombreEntidad() {
		return "auditoria";
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
	public function getModulo() {
		return $this->modulo;
	}

	/**
	 * @param mixed $modulo
	 */
	public function setModulo($modulo) {
		$this->modulo = $modulo;
	}

	/**
	 * @return mixed
	 */
	public function getAccion() {
		return $this->accion;
	}

	/**
	 * @param mixed $accion
	 */
	public function setAccion($accion) {
		$this->accion = $accion;
	}

	/**
	 * @return mixed
	 */
	public function getFechaHora() {
		return $this->fechaHora;
	}

	/**
	 * @param mixed $fechaHora
	 */
	public function setFechaHora($fechaHora) {
		$this->fechaHora = $fechaHora;
	}

	/**
	 * @return mixed
	 */
	public function getIp() {
		return $this->ip;
	}

	/**
	 * @param mixed $ip
	 */
	public function setIp($ip) {
		$this->ip = $ip;
	}
}

<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="parroquia")
 */
class Parroquia extends EntidadBase {
	
	/**
	 * @ORM\Column(type="string", length=3)
	 */
	private $codigo;

	/**
	 * @ORM\Column(type="string", length=80)
	 */
	private $nombre;
	
	/**
	 * @ORM\ManyToOne(targetEntity="Canton", cascade={"persist"})
	 * @ORM\JoinColumn(name="canton_id", referencedColumnName="id")
	 */
	private $canton;
	
	/**
	 *
	 * {@inheritdoc}
	 *
	 * @see \AppBundle\Entity\EntidadBase::getMostrarDetalles()
	 */
	public function getMostrarDetalles() {
		return array (
				$this->id,
				$this->codigo,
				$this->nombre,
				$this->canton,
				$this->canton->getProvincia()
		);
	}
	
	/**
	 *
	 * @return string[]
	 */
	public static function getMostrarCabeceras() {
		return array (
				"id",
				"codigo",
				"nombre",
				"canton",
				"provincia"
		);
	}
	
	/**
	 *
	 * @return string
	 */
	public static function getNombreEntidad() {
		return "parroquia";
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
	public function getCodigo() {
		return $this->codigo;
	}

	/**
	 * @param mixed $codigo
	 */
	public function setCodigo($codigo) {
		$this->codigo = $codigo;
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
	public function getCanton() {
		return $this->canton;
	}

	/**
	 * @param mixed $canton
	 */
	public function setCanton($canton) {
		$this->canton = $canton;
	}
}

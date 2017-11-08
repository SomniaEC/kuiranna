<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="canton")
 */
class Canton extends EntidadBase {
	
	/**
	 * @ORM\Column(type="string", length=3)
	 */
	private $codigo;

	/**
	 * @ORM\Column(type="string", length=80)
	 */
	private $nombre;
	
	/**
	 * @ORM\ManyToOne(targetEntity="Provincia", cascade={"persist"})
	 * @ORM\JoinColumn(name="provincia_id", referencedColumnName="id")
	 */
	private $provincia;
	
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
				$this->provincia
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
				"provincia"
		);
	}
	
	/**
	 *
	 * @return string
	 */
	public static function getNombreEntidad() {
		return "canton";
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
	public function getProvincia() {
		return $this->provincia;
	}

	/**
	 * @param mixed $provincia
	 */
	public function setProvincia($provincia) {
		$this->provincia = $provincia;
	}
}

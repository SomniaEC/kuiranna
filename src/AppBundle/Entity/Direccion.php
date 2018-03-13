<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="direccion")
 */
class Direccion extends EntidadBase {
	
	/**
	 * @ORM\Column(type="string", length=80)
	 */
	private $provincia;
	
	/**
	 * @ORM\Column(type="string", length=80)
	 */
	private $canton;
	
	/**
	 * @ORM\Column(type="string", length=80)
	 */
	private $parroquia;
	
	/**
	 * @ORM\Column(type="string", length=100, nullable=true)
	 */
	private $sector;
	
	/**
	 * @ORM\Column(type="string", length=120)
	 */
	private $zona;
	
	/**
	 * @ORM\Column(type="string", length=120, nullable=true)
	 */
	private $callePrincipal;
	
	/**
	 * @ORM\Column(type="string", length=120, nullable=true)
	 */
	private $calleSecundaria;
	
	/**
	 * @ORM\Column(type="string", length=50, nullable=true)
	 */
	private $numero;
	
	/**
	 * @ORM\Column(type="string", length=250, nullable=true)
	 */
	private $referencia;
	
	/**
	 *
	 * {@inheritdoc}
	 *
	 * @see \AppBundle\Entity\EntidadBase::getMostrarDetalles()
	 */
	public function getMostrarDetalles() {
		return array (
				$this->id,
				$this->provincia,
				$this->canton,
				$this->parroquia,
				$this->sector,
				$this->zona,
				$this->callePrincipal,
				$this->calleSecundaria,
				$this->numero,
				$this->referencia 
		);
	}
	
	/**
	 *
	 * @return string[]
	 */
	public static function getMostrarCabeceras() {
		return array (
				"id",
				"provincia",
				"canton",
				"parroquia",
				"sector",
				"zona",
				"callePrincipal",
				"calleSecundaria",
				"numero",
				"referencia" 
		);
	}
	
	/**
	 *
	 * @return string
	 */
	public static function getNombreEntidad() {
		return "direccion";
	}
	
	/**
	 *
	 * {@inheritdoc}
	 *
	 * @see \AppBundle\Entity\EntidadBase::__toString()
	 */
	public function __toString() {
		return ($this->callePrincipal == null ? "" : $this->callePrincipal) . " " . ($this->numero == null ? "" : $this->numero);
	}
	/**
	 * @return 
	 */
	public function getProvincia() {
		return $this->provincia;
	}

	/**
	 * @param $provincia
	 */
	public function setProvincia($provincia) {
		$this->provincia = $provincia;
	}

	/**
	 * @return
	 */
	public function getCanton() {
		return $this->canton;
	}

	/**
	 * @param $canton
	 */
	public function setCanton($canton) {
		$this->canton = $canton;
	}

	/**
	 * @return
	 */
	public function getParroquia() {
		return $this->parroquia;
	}

	/**
	 * @param $parroquia
	 */
	public function setParroquia($parroquia) {
		$this->parroquia = $parroquia;
	}

	/**
	 * @return
	 */
	public function getSector() {
		return $this->sector;
	}

	/**
	 * @param $sector
	 */
	public function setSector($sector) {
		$this->sector = $sector;
	}

	/**
	 * @return
	 */
	public function getZona() {
		return $this->zona;
	}

	/**
	 * @param $zona
	 */
	public function setZona($zona) {
		$this->zona = $zona;
	}

	/**
	 * @return
	 */
	public function getCallePrincipal() {
		return $this->callePrincipal;
	}

	/**
	 * @param $callePrincipal
	 */
	public function setCallePrincipal($callePrincipal) {
		$this->callePrincipal = $callePrincipal;
	}

	/**
	 * @return
	 */
	public function getCalleSecundaria() {
		return $this->calleSecundaria;
	}

	/**
	 * @param $calleSecundaria
	 */
	public function setCalleSecundaria($calleSecundaria) {
		$this->calleSecundaria = $calleSecundaria;
	}

	/**
	 * @return
	 */
	public function getNumero() {
		return $this->numero;
	}

	/**
	 * @param $numero
	 */
	public function setNumero($numero) {
		$this->numero = $numero;
	}

	/**
	 * @return
	 */
	public function getReferencia() {
		return $this->referencia;
	}

	/**
	 * @param $referencia
	 */
	public function setReferencia($referencia) {
		$this->referencia = $referencia;
	}
}

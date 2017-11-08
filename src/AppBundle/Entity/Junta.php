<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="junta")
 */
class Junta extends EntidadBase {
	
	/**
	 * @ORM\Column(type="string", length=150)
	 */
	private $nombre;
	
	/**
	 * @ORM\Column(type="string", length=13)
	 */
	private $ruc;
	
	/**
	 * @ORM\Column(type="string", length=100)
	 */
	private $telefono;
	
	/**
	 * @ORM\Column(type="string", length=100)
	 * @Assert\Email(message = "El email '{{ value }}' no es valido.")
	 */
	private $email;
	
	/**
	 * @ORM\Column(type="string", length=250)
	 */
	private $logo;
	
	
	/**
	 * @ORM\ManyToOne(targetEntity="Direccion", cascade={"persist", "remove"})
	 * @ORM\JoinColumn(name="direccion_id", referencedColumnName="id")
	 */
	private $direccion;
	
	/**
	 *
	 * {@inheritdoc}
	 *
	 * @see \AppBundle\Entity\EntidadBase::getMostrarDetalles()
	 */
	public function getMostrarDetalles() {
		return array (
				$this->id,
				$this->ruc,
				$this->telefono,
				$this->email,
				$this->logo,
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
				"ruc",
				"telefono",
				"email",
				"logo",
				"nombre" 
		);
	}
	
	public function __toString() {
		return $this->nombre;
	}
	
	/**
	 *
	 * @return string
	 */
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
	 * @return mixed
	 */
	public function getRuc() {
		return $this->ruc;
	}

	/**
	 * @param mixed $ruc
	 */
	public function setRuc($ruc) {
		$this->ruc = $ruc;
	}

	/**
	 * @return mixed
	 */
	public function getTelefono() {
		return $this->telefono;
	}

	/**
	 * @param mixed $telefono
	 */
	public function setTelefono($telefono) {
		$this->telefono = $telefono;
	}

	/**
	 * @return mixed
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * @param mixed $email
	 */
	public function setEmail($email) {
		$this->email = $email;
	}

	/**
	 * @return mixed
	 */
	public function getLogo() {
		return $this->logo;
	}

	/**
	 * @param mixed $logo
	 */
	public function setLogo($logo) {
		$this->logo = $logo;
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
	 * Set direccion
	 *
	 * @param \AppBundle\Entity\Direccion $direccion        	
	 *
	 * @return Junta
	 */
	public function setDireccion(\AppBundle\Entity\Direccion $direccion = null) {
		$this->direccion = $direccion;
		
		return $this;
	}
	
	/**
	 * Get direccion
	 *
	 * @return \AppBundle\Entity\Direccion
	 */
	public function getDireccion() {
		return $this->direccion;
	}
}

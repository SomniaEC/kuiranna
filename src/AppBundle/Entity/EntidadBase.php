<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\MappedSuperclass
 */
abstract class EntidadBase {
	/**
	 * @ORM\Column(type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $id;
	
	/**
	 * Set id
	 *
	 * @param string $id        	
	 *
	 * @return EntidadBase
	 */
	public function setId($id) {
		$this->id = id;
		
		return $this;
	}
	
	/**
	 * Get id
	 *
	 * @return string
	 */
	public function getId() {
		return $this->id;
	}
	public abstract function getMostrarDetalles();
	public abstract function getMostrarCabeceras();
}

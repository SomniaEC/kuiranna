<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\ConstantesDeOperaciones;

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
	public abstract function getMostrarCabeceras();
	public abstract function getMostrarDetalles();
	public static abstract function getNombreEntidad();
	public static function getRutas(){
		return array('ruta_mostrar' => ConstantesDeOperaciones::MOSTRAR . '_' . static::getNombreEntidad(),
						'ruta_modificar' => ConstantesDeOperaciones::MODIFICAR . '_' . static::getNombreEntidad(),
						'ruta_eliminar' => ConstantesDeOperaciones::ELIMINAR . '_' . static::getNombreEntidad());
	}
}

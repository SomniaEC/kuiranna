<?php

namespace AppBundle\Entity;

use AppBundle\ConstantesDeOperaciones;
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
	public abstract function getMostrarCabeceras();
	public abstract function getMostrarDetalles();
	public static abstract function getNombreEntidad();
	public static function getRutas() {
		return array (
				'ruta_mostrar' => ConstantesDeOperaciones::MOSTRAR . '_entidad',
				'ruta_modificar' => ConstantesDeOperaciones::MODIFICAR . '_entidad',
				'ruta_eliminar' => ConstantesDeOperaciones::ELIMINAR . '_entidad',
				'ruta_crear' => ConstantesDeOperaciones::CREAR . '_' . static::getNombreEntidad (),
				'ruta_prueba' => ConstantesDeOperaciones::PRUEBA . '_'
		);
	}
}

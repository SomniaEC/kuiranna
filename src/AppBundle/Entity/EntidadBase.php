<?php

namespace AppBundle\Entity;

use AppBundle\ConstantesDeEstado;
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
	 * @ORM\Column(type="string")
	 */
	protected $estado = ConstantesDeEstado::ACTIVO;
	
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
	/**
	 * Set estado
	 *
	 * @param string $estado        	
	 *
	 * @return EntidadBase
	 */
	public function setEstado($estado) {
		$this->estado = estado;
		
		return $this;
	}
	
	/**
	 * Get estado
	 *
	 * @return string
	 */
	public function getEstado() {
		return $this->estado;
	}
	public static abstract function getMostrarCabeceras();
	public abstract function getMostrarDetalles();
	public static abstract function getNombreEntidad();
	public static function getRutas() {
		return array (
				'ruta_mostrar' => ConstantesDeOperaciones::MOSTRAR . '_entidad',
				'ruta_modificar' => ConstantesDeOperaciones::MODIFICAR . '_entidad',
				'ruta_eliminar' => ConstantesDeOperaciones::ELIMINAR . '_entidad',
				'ruta_crear' => ConstantesDeOperaciones::CREAR . '_' . static::getNombreEntidad (),
				'ruta_prueba' => ConstantesDeOperaciones::PRUEBA . '_',
				'ruta_listar' => ConstantesDeOperaciones::LISTAR . '_entidad' 
		);
	}
	public abstract function __toString();
}

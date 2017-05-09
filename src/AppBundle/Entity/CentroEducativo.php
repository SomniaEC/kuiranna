<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="centroEducativo")
 */
class CentroEducativo extends EntidadBase {
	/**
	 * @ORM\Column(type="string", length=250)
	 */
	private $nombre;
	
	public function getMostrarDetalles() {
		return array($this->id, $this->nombre);
	}
	
	public static function getMostrarCabeceras() {
		return array("id", "nombre");
	}
	
	public static function getNombreEntidad() {
		return "centroEducativo";
	}

 
    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return CentroEducativo
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }
    
    public function __toString() {
    	return $this->nombre;
    }
}

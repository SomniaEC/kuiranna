<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="domicilio")
 */
class Domicilio extends EntidadBase {
	/**
	 * @ORM\Column(type="string", length=250)
	 */
	private $direccion;
	
	/**
	 * @ORM\Column(type="string", length=250)
	 */
	private $referencia;
	
	/**
	 * @ORM\Column(type="string", length=250)
	 */
	private $descripcionCasa;
	
	/**
	 * @ORM\Column(type="string", length=45)
	 */
	private $provincia;
	
	/**
	 * @ORM\Column(type="string", length=45)
	 */
	private $canton;
	
	/**
	 * @ORM\Column(type="string", length=45)
	 */
	private $sector;
	
	public function getMostrarDetalles() {
		return array($this->id, $this->direccion, $this->referencia, $this->descripcionCasa, $this->provincia, $this->canton, $this->sector);
	}
	
	public function getMostrarCabeceras() {
		return array("id", "direccion", "referencia","descripcion de la casa","provincia", "canton", "sector");
	}
	
	public static function getNombreEntidad() {
		return "domicilio";
	}

    /**
     * Set direccion
     *
     * @param string $direccion
     *
     * @return Domicilio
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set referencia
     *
     * @param string $referencia
     *
     * @return Domicilio
     */
    public function setReferencia($referencia)
    {
        $this->referencia = $referencia;

        return $this;
    }

    /**
     * Get referencia
     *
     * @return string
     */
    public function getReferencia()
    {
        return $this->referencia;
    }

    /**
     * Set descripcionCasa
     *
     * @param string $descripcionCasa
     *
     * @return Domicilio
     */
    public function setDescripcionCasa($descripcionCasa)
    {
        $this->descripcionCasa = $descripcionCasa;

        return $this;
    }

    /**
     * Get descripcionCasa
     *
     * @return string
     */
    public function getDescripcionCasa()
    {
        return $this->descripcionCasa;
    }

    /**
     * Set provincia
     *
     * @param string $provincia
     *
     * @return Domicilio
     */
    public function setProvincia($provincia)
    {
        $this->provincia = $provincia;

        return $this;
    }

    /**
     * Get provincia
     *
     * @return string
     */
    public function getProvincia()
    {
        return $this->provincia;
    }

    /**
     * Set canton
     *
     * @param string $canton
     *
     * @return Domicilio
     */
    public function setCanton($canton)
    {
        $this->canton = $canton;

        return $this;
    }

    /**
     * Get canton
     *
     * @return string
     */
    public function getCanton()
    {
        return $this->canton;
    }

    /**
     * Set sector
     *
     * @param string $sector
     *
     * @return Domicilio
     */
    public function setSector($sector)
    {
        $this->sector = $sector;

        return $this;
    }

    /**
     * Get sector
     *
     * @return string
     */
    public function getSector()
    {
        return $this->sector;
    }
}

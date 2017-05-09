<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="archivoDigitaizados")
 */
class ArchivoDigitalizado extends EntidadBase {
	
	/**
	 * @ORM\Column(type="string", length=250)
	 */
	private $nombre;
	
	/**
	 * @ORM\Column(type="string", length=45)
	 */
	private $tipo;
	
	/**
	 * @ORM\Column(type="string", length=250)
	 */
	private $path;
	
	/**
	 * @ORM\ManyToOne(targetEntity="Denuncia", cascade={"persist"})
	 * @ORM\JoinColumn(name="denuncia_id", referencedColumnName="id")
	 */
	private $denuncia;
	public function getMostrarDetalles() {
		return array (
				$this->id,
				$this->nombre,
				$this->tipo,
				$this->path,
				$this->denuncia 
		);
	}
	public static function getMostrarCabeceras() {
		return array (
				"id",
				"nombre",
				"tipo",
				"path",
				"denuncia" 
		);
	}
	public static function getNombreEntidad() {
		return "archivoDigitalizado";
	}
	public function __toString() {
		return $this->nombre;
	}

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return ArchivoDigitalizado
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

    /**
     * Set tipo
     *
     * @param string $tipo
     *
     * @return ArchivoDigitalizado
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return string
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set path
     *
     * @param string $path
     *
     * @return ArchivoDigitalizado
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set denuncia
     *
     * @param \AppBundle\Entity\Denuncia $denuncia
     *
     * @return ArchivoDigitalizado
     */
    public function setDenuncia(\AppBundle\Entity\Denuncia $denuncia = null)
    {
        $this->denuncia = $denuncia;

        return $this;
    }

    /**
     * Get denuncia
     *
     * @return \AppBundle\Entity\Denuncia
     */
    public function getDenuncia()
    {
        return $this->denuncia;
    }
}

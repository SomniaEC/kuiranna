<?php

namespace AppBundle\Controller;

use AppBundle\Entity\CentroEducativo;
use AppBundle\Entity\Denuncia;
use AppBundle\Entity\Domicilio;
use AppBundle\Entity\Vulnerado;
use AppBundle\Entity\VulneradoDomicilio;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class VulneradoDomicilioController extends Controller {
	/**
	 * @Route("/vulneradoDomicilio/prueba", name="prueba_vulneradoDomicilio")
	 */
	public function createAction() {
		$vulneradoDomicilio = new VulneradoDomicilio ();
		$vulneradoDomicilio->setViveCon ( "Madre: Maria del Rosario Rosas Rojas" );
		
		$domicilio = new Domicilio ();
		$domicilio->setDireccion ( "12 de Octubre y Coruña" );
		$domicilio->setReferencia ( "plaza artigas" );
		$domicilio->setDescripcionCasa ( "edificio Urban Plaza" );
		$domicilio->setProvincia ( "Pichincha" );
		$domicilio->setCanton ( "Quito" );
		$domicilio->setSector ( "Floresta" );
		$vulneradoDomicilio->setDomicilio ( $domicilio );
		
		$vulnerado = new Vulnerado ();
		$vulnerado->setCedula ( "1713848172" );
		$vulnerado->setNombres ( "César León" );
		$vulnerado->setTieneCapacidadEspecial ( false );
		$vulnerado->setFechaNacimiento ( new \DateTime ( "21-11-1990" ) ); // dd-mm-aaaa
		
		$centroEducativo = new CentroEducativo ();
		$centroEducativo->setNombre ( "Centro Educativo de Prueba" );
		$vulnerado->setCentroEducativo ( $centroEducativo );
		$vulnerado->setNombresMadre ( "Doña mamá" );
		$vulnerado->setNombresPadre ( "Don papá" );
		$vulnerado->setNacionalidad ( "Rumano" );
		$vulneradoDomicilio->setVulnerado ( $vulnerado );
		
		$denuncia = new Denuncia ();
		$denuncia->setFechaRegistro ( new \DateTime ( date ( "d-m-Y" ) ) );
		$denuncia->setHechos ( "Los hechos fueron estos y estos ........" );
		$vulneradoDomicilio->setDenuncia ( $denuncia );
		
		$em = $this->getDoctrine ()->getManager ();
		
		// tells Doctrine you want to (eventually) save the Product (no queries yet)
		$em->persist ( $vulneradoDomicilio );
		
		// actually executes the queries (i.e. the INSERT query)
		$em->flush ();
		
		return $this->redirectToRoute ( "listar_entidad", array (
				"nombreEntidad" => "vulneradoDomicilio",
				"mensaje" => "Vulnerado Domicilio de prueba guardado con id: " . $vulneradoDomicilio->getId () 
		) );
	}
}
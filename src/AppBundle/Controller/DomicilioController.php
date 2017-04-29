<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Domicilio;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DomicilioController extends Controller {
	/**
	 * @Route("/domicilio/prueba")
	 */
	public function createAction() {
		$domicilio = new Domicilio ();
		$domicilio->setDireccion ( "Eloy Alfaro y Catalina Aldaz" );
		$domicilio->setReferencia ( "junto a alitas del Cadilac" );
		$domicilio->setDescripcionCasa ( "edificio Maldonado Correa" );
		$domicilio->setProvincia ( "Pichincha" );
		$domicilio->setCanton ( "Quito" );
		$domicilio->setSector ( "Bellavista" );
		
		$em = $this->getDoctrine ()->getManager ();
		
		$em->persist ( $domicilio );
		
		$em->flush ();
		
		return $this->redirectToRoute ( "listar_entidad", array (
				"nombreEntidad" => "domicilio",
				"mensaje" => "Domicilio de prueba guardada con id: " . $persona->getId () 
		) );
	}
}
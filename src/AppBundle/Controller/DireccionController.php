<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Direccion;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DireccionController extends Controller {
	/**
	 * @Route("/direccion/prueba", name="prueba_direccion")
	 */
	public function createAction() {
		$direccion = new Direccion ();
		$direccion->setProvincia ( "Pichincha" );
		$direccion->setCanton ( "Quito" );
		$direccion->setParroquia ( "Benalcazar" );
		$direccion->setSector ( "Bellavista" );
		$direccion->setZona("Centro-Norte");
		$direccion->setCallePrincipal("Eloy Alfaro");
		$direccion->setCalleSecundaria("Catalina Aldaz");
		$direccion->setNumero("N24-554");
		$direccion->setReferencia ( "junto a alitas del Cadilac" );
		
		$em = $this->getDoctrine ()->getManager ();
		
		$em->persist ( $direccion );
		
		$em->flush ();
		
		return $this->redirectToRoute ( "listar_entidad", array (
				"nombreEntidad" => "direccion",
				"mensaje" => "Dirección de prueba guardada con id: " . $direccion->getId () 
		) );
	}
}
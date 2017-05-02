<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Junta;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Domicilio;

class JuntaController extends Controller {
	/**
	 * @Route("/junta/prueba", name="prueba_junta")
	 */
	public function createAction() {
		$junta = new Junta();
		$junta->setNombre('Quito Norte');
		
		$domicilio = new Domicilio();
		$domicilio->setDireccion ( "12 de Octubre y Coruña" );
		$domicilio->setReferencia ( "plaza artigas" );
		$domicilio->setDescripcionCasa ( "edificio Urban Plaza" );
		$domicilio->setProvincia ( "Pichincha" );
		$domicilio->setCanton ( "Quito" );
		$domicilio->setSector ( "Floresta" );
		
		$junta->setDomicilio($domicilio);
		
		$em = $this->getDoctrine ()->getManager ();
		
		// tells Doctrine you want to (eventually) save the Product (no queries yet)
		$em->persist ( $junta );
		
		// actually executes the queries (i.e. the INSERT query)
		$em->flush ();
		
		return $this->redirectToRoute ( "listar_entidad", array (
				"nombreEntidad" => "junta",
				"mensaje" => "Junta de prueba con domicilio guardada con id: " . $junta->getId () 
		) );
	}
}
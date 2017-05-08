<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Denuncia;
use AppBundle\Entity\Domicilio;
use AppBundle\Entity\Persona;
use AppBundle\Entity\PersonaDomicilio;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PersonaDomicilioController extends Controller {
	/**
	 * @Route("/personaDomicilio/prueba", name="prueba_personaDomicilio")
	 */
	public function createAction() {
		$personaDomicilio = new PersonaDomicilio ();
		$personaDomicilio->setTipo ( "Tipo1" );
		
		$domicilio = new Domicilio ();
		$domicilio->setDireccion ( "12 de Octubre y Coruña" );
		$domicilio->setReferencia ( "plaza artigas" );
		$domicilio->setDescripcionCasa ( "edificio Urban Plaza" );
		$domicilio->setProvincia ( "Pichincha" );
		$domicilio->setCanton ( "Quito" );
		$domicilio->setSector ( "Floresta" );
		$personaDomicilio->setDomicilio ( $domicilio );
		
		$persona = new Persona ();
		$persona->setCedula ( "1713848172" );
		$persona->setNombres ( "César León" );
		$persona->setTelefono( "022123456" );
		$persona->setEmail( "" );
		$persona->setFechaNacimiento ( new \DateTime ( "21-11-1990" ) ); // dd-mm-aaaa
		$persona->setNacionalidad ( "Rumano" );
		$personaDomicilio->setPersona ( $persona );
		
		$denuncia = new Denuncia ();
		$denuncia->setFechaRegistro ( new \DateTime ( date ( "d-m-Y" ) ) );
		$denuncia->setHechos ( "Los hechos fueron estos y estos ........" );
		$personaDomicilio->setDenuncia ( $denuncia );
		
		$em = $this->getDoctrine ()->getManager ();
		
		// tells Doctrine you want to (eventually) save the Product (no queries yet)
		$em->persist ( $personaDomicilio );
		
		// actually executes the queries (i.e. the INSERT query)
		$em->flush ();
		
		return $this->redirectToRoute ( "listar_entidad", array (
				"nombreEntidad" => "personaDomicilio",
				"mensaje" => "Persona Domicilio de prueba guardado con id: " . $personaDomicilio->getId () 
		) );
	}
}
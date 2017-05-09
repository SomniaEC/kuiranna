<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Persona;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PersonaController extends Controller {
	/**
	 * @Route("/persona/prueba", name="prueba_persona")
	 */
	public function createAction() {
		$persona = new Persona ();
		$persona->setCedula ( "1713848172" );
		$persona->setEmail ( "cesarivanleon@gmail.com" );
		$persona->setFechaNacimiento ( new \DateTime ( "21-11-1990" ) ); // dd-mm-aaaa
		$persona->setNacionalidad ( "Ecuatoriano" );
		$persona->setTelefono ( "0998746548" );
		$persona->setNombres ( "César León" );
		
		$em = $this->getDoctrine ()->getManager ();
		
		// tells Doctrine you want to (eventually) save the Product (no queries yet)
		$em->persist ( $persona );
		
		// actually executes the queries (i.e. the INSERT query)
		$em->flush ();
		
		return $this->redirectToRoute ( "listar_entidad", array (
				"nombreEntidad" => "persona",
				"mensaje" => "Persona de prueba guardada con id: " . $persona->getId () 
		) );
	}
}
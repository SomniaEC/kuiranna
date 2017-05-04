<?php

namespace AppBundle\Controller;

use AppBundle\Entity\CentroEducativo;
use AppBundle\Entity\Vulnerado;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class VulneradoController extends Controller {
	/**
	 * @Route("/vulnerado/prueba", name="prueba_vulnerado")
	 */
	public function createAction() {
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
		$vulnerado->setNacionalidad( "Rumano" );
		
		$em = $this->getDoctrine ()->getManager ();
		
		// tells Doctrine you want to (eventually) save the Product (no queries yet)
		$em->persist ( $vulnerado );
		
		// actually executes the queries (i.e. the INSERT query)
		$em->flush ();
		
		return $this->redirectToRoute ( "listar_entidad", array (
				"nombreEntidad" => "vulnerado",
				"mensaje" => "Vulnerado de prueba guardada con id: " . $vulnerado->getId () 
		) );
	}
}
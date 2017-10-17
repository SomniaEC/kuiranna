<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Plantilla;

class PlantillaController extends Controller {
	/**
	 * @Route("/plantilla/prueba", name="prueba_plantilla")
	 */
	public function createAction() {
		$plantilla = new Plantilla ();
		$plantilla->setTipo ( "Audiencia de Prueba" );
		$plantilla->setNombre ( "Audiencia 1" );
		$plantilla->setDatos ( "12345678" );
		
		$em = $this->getDoctrine ()->getManager ();
		
		$juntas = $em->getRepository ( 'AppBundle:Junta' )->findAll ();
		
		if (! empty ( $juntas )) {
			$plantilla->setJunta ( $juntas [array_rand ( $juntas )] );
		}
		
		$em->persist ( $plantilla );
		$em->flush ();
		
		return $this->redirectToRoute ( "listar_entidad", array (
				"nombreEntidad" => "plantilla",
				"mensaje" => "Plantilla de prueba guardada con id: " . $plantilla->getId () 
		) );
	}
}
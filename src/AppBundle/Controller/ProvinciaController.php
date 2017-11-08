<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Provincia;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProvinciaController extends Controller {
	/**
	 * @Route("/provincia/prueba", name="prueba_provincia")
	 */
	public function createAction() {
		$provincia = new Provincia ();
		$provincia->setCodigo("01");
		$provincia->setNombre ( "Provincia del Azuay" );
		
		$em = $this->getDoctrine ()->getManager ();
		$em->persist ( $provincia );
		$em->flush ();
		
		return $this->redirectToRoute ( "listar_entidad", array (
				"nombreEntidad" => "provincia",
				"mensaje" => "Provincia de prueba guardado con id: " . $provincia->getId () 
		) );
	}
}
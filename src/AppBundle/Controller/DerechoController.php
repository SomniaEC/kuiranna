<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Derecho;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DerechoController extends Controller {
	/**
	 * @Route("/derecho/prueba", name="prueba_derecho")
	 */
	public function createAction() {
		$derecho = new Derecho ();
		$derecho->setNombre ( "Derecho de Prueba" );
		
		$em = $this->getDoctrine ()->getManager ();
		$em->persist ( $derecho );
		$em->flush ();
		
		return $this->redirectToRoute ( "listar_entidad", array (
				"nombreEntidad" => "derecho",
				"mensaje" => "Derecho de prueba guardado con id: " . $derecho->getId () 
		) );
	}
}
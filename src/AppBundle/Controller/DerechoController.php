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
		$derecho->setTipo ( "DERECHOS DE SUPERVIVENCIA" );
		$derecho->setNombre ( "Art. 21" );
		$derecho->setDescripcion( "Derecho a conocer a los progenitores y a mantener relaciones con ellos" );
		
		$em = $this->getDoctrine ()->getManager ();
		$em->persist ( $derecho );
		$em->flush ();
		
		return $this->redirectToRoute ( "listar_entidad", array (
				"nombreEntidad" => "derecho",
				"mensaje" => "Derecho de prueba guardado con id: " . $derecho->getId () 
		) );
	}
}
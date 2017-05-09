<?php

namespace AppBundle\Controller;

use AppBundle\Entity\CentroEducativo;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CentroEducativoController extends Controller {
	/**
	 * @Route("/centroEducativo/prueba", name="prueba_centroEducativo")
	 */
	public function createAction() {
		$centroEducativo = new CentroEducativo ();
		$centroEducativo->setNombre ( "Centro Educativo de Prueba" );
		
		$em = $this->getDoctrine ()->getManager ();
		$em->persist ( $centroEducativo );
		$em->flush ();
		
		return $this->redirectToRoute ( "listar_entidad", array (
				"nombreEntidad" => "centroEducativo",
				"mensaje" => "Centro Educativo de prueba guardada con id: " . $centroEducativo->getId () 
		) );
	}
}
<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Canton;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Provincia;

class CantonController extends Controller {
	/**
	 * @Route("/canton/prueba", name="prueba_canton")
	 */
	public function createAction() {
		$canton = new Canton ();
		$canton->setCodigo ( "01" );
		$canton->setNombre ( "Tulcan" );
		
		$em = $this->getDoctrine ()->getManager ();
		
		$provincia = $em->getRepository ( 'AppBundle:Provincia' )->findOneBy ( array (
				'codigo' => '04' 
		) );
		
		if (empty ( $provincia )) {
			$provincia = new Provincia ();
			$provincia->setCodigo ( "04" );
			$provincia->setNombre ( "Carchi" );
		}
		
		$canton->setProvincia ( $provincia );
		
		$em->persist ( $canton );
		$em->flush ();
		
		return $this->redirectToRoute ( "listar_entidad", array (
				"nombreEntidad" => "canton",
				"mensaje" => "Canton de prueba guardado con id: " . $canton->getId () 
		) );
	}
}
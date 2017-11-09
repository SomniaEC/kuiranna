<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Parroquia;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Canton;
use AppBundle\Entity\Provincia;

class ParroquiaController extends Controller {
	/**
	 * @Route("/parroquia/prueba", name="prueba_parroquia")
	 */
	public function createAction() {
		$parroquia = new Parroquia ();
		$parroquia->setCodigo ( '50' );
		$parroquia->setNombre ( 'Pto Francisco de Orellana' );
		
		$em = $this->getDoctrine ()->getManager ();
		
		$canton = $em->getRepository ( 'AppBundle:Canton' )->findOneBy ( array (
				'codigo' => '01', 'nombre' => 'Canton Orellana'
		) );
		
		if (empty ( $canton )) {
			$canton = new Canton ();
			$canton->setCodigo ( '01' );
			$canton->setNombre ( 'Canton Orellana' );
			
			$provincia = $em->getRepository ( 'AppBundle:Provincia' )->findOneBy ( array (
					'codigo' => '22'
			) );
			
			if (empty ( $provincia )) {
				$provincia = new Provincia();
				$provincia->setCodigo('22');
				$provincia->setNombre('Orellana');
			}
			
			$canton->setProvincia($provincia);
		}
		
		$parroquia->setCanton ( $canton );
		
		$em->persist ( $parroquia );
		$em->flush ();
		
		return $this->redirectToRoute ( "listar_entidad", array (
				"nombreEntidad" => "parroquia",
				"mensaje" => "Parroquia de prueba guardado con id: " . $parroquia->getId () 
		) );
	}
}
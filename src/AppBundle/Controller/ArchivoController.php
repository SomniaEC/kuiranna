<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Archivo;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ArchivoController extends Controller {
	/**
	 * @Route("/archivo/prueba", name="prueba_archivo")
	 */
	public function createAction() {
		$archivo = new Archivo ();
		$archivo->setNombre ( 'Archivo' );
		$archivo->setTipo ( 'Escaneado' );
		$archivo->setPath ( '/dummypath/file.jpg' );
		
		$em = $this->getDoctrine ()->getManager ();
		$denuncias = $em->getRepository ( 'AppBundle:Denuncia' )->findAll ();
		
		if (!empty ( $denuncias )) {
			$archivo->setDenuncia ( $denuncias [array_rand ( $denuncias )] );
		}
		
		$em->persist ( $archivo );
		
		$em->flush ();
		
		return $this->redirectToRoute ( "listar_entidad", array (
				"nombreEntidad" => "archivo",
				"Archivo de prueba de una denuncia guardado con id: " . $archivo->getId ()
		) );
	}
}
<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ArchivoDigitalizado;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ArchivoDigitalizadoController extends Controller {
	/**
	 * @Route("/archivoDigitalizado/prueba", name="prueba_archivoDigitalizado")
	 */
	public function createAction() {
		$archivoDigitalizado = new ArchivoDigitalizado ();
		$archivoDigitalizado->setNombre ( 'Archivo Digitaliado' );
		$archivoDigitalizado->setTipo ( 'Archivo Tipo 1' );
		$archivoDigitalizado->setPath ( '/dummypath/file.jpg' );
		
		$em = $this->getDoctrine ()->getManager ();
		$denuncias = $em->getRepository ( 'AppBundle:Denuncia' )->findAll ();
		
		if (empty ( $denuncias )) {
			return $this->redirectToRoute ( "listar_entidad", array (
					"nombreEntidad" => "archivoDigitalizado",
					"mensaje" => "No se puede agregar Archivo Digitalizado de prueba. No existe una denuncia" 
			) );
		}
		
		$archivoDigitalizado->setDenuncia ( $denuncias [array_rand ( $denuncias )] );
		
		// tells Doctrine you want to (eventually) save the Product (no queries yet)
		$em->persist ( $archivoDigitalizado );
		
		// actually executes the queries (i.e. the INSERT query)
		$em->flush ();
		
		return $this->redirectToRoute ( "listar_entidad", array (
				"nombreEntidad" => "archivoDigitalizado",
				"mensaje" => "Archivo Digitalizado de prueba con denuncia guardada con id: " . $archivoDigitalizado->getId () 
		) );
	}
}
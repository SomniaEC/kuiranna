<?php

namespace AppBundle\Controller;

use AppBundle\Entity\CentroEducativo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Direccion;

class CentroEducativoController extends Controller {
	/**
	 * @Route("/centroEducativo/prueba", name="prueba_centroEducativo")
	 */
	public function createAction() {
		$centroEducativo = new CentroEducativo ();
		$centroEducativo->setIdentificacion ( "1758954587001" );
		$centroEducativo->setNombre ( "Centro Educativo de Prueba" );
		$centroEducativo->setTelefono ( "022487895" );
		
		$direccion = new Direccion ();
		$direccion->setProvincia ( "Pichincha" );
		$direccion->setCanton ( "Quito" );
		$direccion->setParroquia ( "Norte" );
		$direccion->setSector ( "Plaza Artigas" );
		$direccion->setZona ( "Centro-Norte" );
		$direccion->setCallePrincipal ( "Av. La Coruna" );
		$direccion->setCalleSecundaria ( "Av. 12 de Octubre" );
		$direccion->setNumero ( "E123-456" );
		$direccion->setReferencia ( "centro educativo" );
		
		$centroEducativo->setDireccion ( $direccion );
		
		$em = $this->getDoctrine ()->getManager ();
		
		$juntas = $em->getRepository ( 'AppBundle:Junta' )->findAll ();
		
		if (! empty ( $juntas )) {
			$centroEducativo->setJunta ( $juntas [array_rand ( $juntas )] );
		}
		
		$em->persist ( $centroEducativo );
		$em->flush ();
		
		return $this->redirectToRoute ( "listar_entidad", array (
				"nombreEntidad" => "centroEducativo",
				"mensaje" => "Centro Educativo de prueba guardada con id: " . $centroEducativo->getId () 
		) );
	}
}
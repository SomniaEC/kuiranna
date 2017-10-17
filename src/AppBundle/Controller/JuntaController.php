<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Junta;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Direccion;

class JuntaController extends Controller {
	/**
	 * @Route("/junta/prueba", name="prueba_junta")
	 */
	public function createAction() {
		$junta = new Junta();
		$junta->setNombre('Quito Norte');
		$junta->setRuc('1706432359');
		$junta->setTelefono('022243244');
		$junta->setEmail('123@abc.com');
		$junta->setLogo('\home\images\logo.png');
		
		$direccion = new Direccion();
		$direccion->setProvincia ( "Pichincha" );
		$direccion->setCanton ( "Quito" );
		$direccion->setParroquia ( "Floresta" );
		$direccion->setSector ( "Plaza Artigas" );
		$direccion->setZona("Centro-Norte");
		$direccion->setCallePrincipal("Av. La Coruna");
		$direccion->setCalleSecundaria("Av. 12 de Octubre");
		$direccion->setNumero("N24-564");
		$direccion->setReferencia ( "junta" );
		
		$junta->setDireccion($direccion);
		
		$em = $this->getDoctrine ()->getManager ();
		
		$em->persist ( $junta );
		
		$em->flush ();
		
		return $this->redirectToRoute ( "listar_entidad", array (
				"nombreEntidad" => "junta",
				"mensaje" => "Junta de prueba con direccion guardada con id: " . $junta->getId () 
		) );
	}
}
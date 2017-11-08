<?php

namespace AppBundle\Controller;

use AppBundle\Entity\CentroEducativo;
use AppBundle\Entity\Vulnerado;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Direccion;

class VulneradoController extends Controller {
	/**
	 * @Route("/vulnerado/prueba", name="prueba_vulnerado")
	 */
	public function createAction() {
		$vulnerado = new Vulnerado ();
		$vulnerado->setIdentificacion ( "1713848172" );
		$vulnerado->setNombres ( "Carlos Carrillo" );
		$vulnerado->setFechaNacimiento ( new \DateTime ( "21-11-1990" ) ); // dd-mm-aaaa
		$vulnerado->setSexo ( "Hombre" );
		$vulnerado->setGenero ( "Masculino" );
		$vulnerado->setNacionalidad ( "Ecuatoriano" );
		$vulnerado->setInterculturalidad ( "Mestizo" );
		$vulnerado->setOcupacion ( "Estudiante" );
		$vulnerado->setInstruccion ( "Secundaria" );
		$vulnerado->setCapacidadEspecial ( false );
		$vulnerado->setLegalidad ( "Refugiado" );
		$vulnerado->setTelefono ( "0998746548" );
		$vulnerado->setEmail ( "cesarivanleon@gmail.com" );
		
		$em = $this->getDoctrine ()->getManager ();
		
		$centrosEducativos = $em->getRepository ( 'AppBundle:CentroEducativo' )->findAll ();
		
		if (! empty ( $centrosEducativos )) {
			$centroEducativo = $centrosEducativos [array_rand ( $centrosEducativos )];
		} else {
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
		}
		
		$vulnerado->setCentroEducativo($centroEducativo);
		
		// tells Doctrine you want to (eventually) save the Product (no queries yet)
		$em->persist ( $vulnerado );
		
		// actually executes the queries (i.e. the INSERT query)
		$em->flush ();
		
		return $this->redirectToRoute ( "listar_entidad", array (
				"nombreEntidad" => "vulnerado",
				"mensaje" => "Vulnerado de prueba guardada con id: " . $vulnerado->getId () 
		) );
	}
}
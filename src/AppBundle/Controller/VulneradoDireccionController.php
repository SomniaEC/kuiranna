<?php

namespace AppBundle\Controller;

use AppBundle\Entity\CentroEducativo;
use AppBundle\Entity\Denuncia;
use AppBundle\Entity\Direccion;
use AppBundle\Entity\Vulnerado;
use AppBundle\Entity\VulneradoDireccion;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class VulneradoDireccionController extends Controller {
	/**
	 * @Route("/vulneradoDireccion/prueba", name="prueba_vulneradoDireccion")
	 */
	public function createAction() {
		$vulneradoDireccion = new VulneradoDireccion ();
		
		$direccion = new Direccion ();
		$direccion->setProvincia ( "Pichincha" );
		$direccion->setCanton ( "Quito" );
		$direccion->setParroquia ( "Benalcazar" );
		$direccion->setSector ( "Bellavista" );
		$direccion->setZona ( "Centro-Norte" );
		$direccion->setCallePrincipal ( "Eloy Alfaro" );
		$direccion->setCalleSecundaria ( "Catalina Aldaz" );
		$direccion->setNumero ( "N24-554" );
		$direccion->setReferencia ( "vulnerado" );
		$vulneradoDireccion->setDireccion ( $direccion );
		
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
		
		$vulnerado->setCentroEducativo ( $centroEducativo );
		
		$vulneradoDireccion->setVulnerado ( $vulnerado );
		
		$denuncias = $em->getRepository ( 'AppBundle:Denuncia' )->findAll ();
		
		if (! empty ( $denuncias )) {
			$denuncia = $denuncias [array_rand ( $denuncias )];
		} else {
			$denuncia = new Denuncia ();
			$denuncia->setCreacion ( new \DateTime ( date ( "d-m-Y" ) ) );
			$denuncia->setHechos ( "Los hechos fueron estos y estos ........" );
			$denuncia->setRecursoImpugnacion ( "Reposicion" );
			$denuncia->setTipoMaltrato ( "Trabajo Infantil" );
			$denuncia->setAmbitoMaltrato ( "Familiar" );
			$denuncia->setVulneradoresDerechos ( "Madre;Padre" );
		}
		$vulneradoDireccion->setDenuncia ( $denuncia );
		
		// tells Doctrine you want to (eventually) save the Product (no queries yet)
		$em->persist ( $vulneradoDireccion );
		
		// actually executes the queries (i.e. the INSERT query)
		$em->flush ();
		
		return $this->redirectToRoute ( "listar_entidad", array (
				"nombreEntidad" => "vulneradoDireccion",
				"mensaje" => "Vulnerado Direccion de prueba guardado con id: " . $vulneradoDireccion->getId () 
		) );
	}
}
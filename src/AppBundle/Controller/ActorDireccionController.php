<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Denuncia;
use AppBundle\Entity\Direccion;
use AppBundle\Entity\Actor;
use AppBundle\Entity\ActorDireccion;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Utils\ConstantesDeRolActor;

class ActorDireccionController extends Controller {
	/**
	 * @Route("/actorDireccion/prueba", name="prueba_actorDireccion")
	 */
	public function createAction() {
		$actorDireccion = new ActorDireccion ();
		$actorDireccion->setRol ( ConstantesDeRolActor::Denunciante);
		
		$direccion = new Direccion ();
		$direccion->setProvincia ( "Pichincha" );
		$direccion->setCanton ( "Quito" );
		$direccion->setParroquia ( "Floresta" );
		$direccion->setSector ( "Plaza Artigas" );
		$direccion->setZona ( "Centro-Norte" );
		$direccion->setCallePrincipal ( "Av. La Coruna" );
		$direccion->setCalleSecundaria ( "Av. 12 de Octubre" );
		$direccion->setNumero ( "N24-564" );
		$direccion->setReferencia ( "junto redondel de la plaza artigas" );
		$actorDireccion->setDireccion ( $direccion );
		
		$direccionTrabajo = new Direccion ();
		$direccionTrabajo->setProvincia ( "Pichincha" );
		$direccionTrabajo->setCanton ( "Quito" );
		$direccionTrabajo->setParroquia ( "Miraflores" );
		$direccionTrabajo->setSector ( "Universidad Central" );
		$direccionTrabajo->setZona ( "Centro-Norte" );
		$direccionTrabajo->setCallePrincipal ( "Av. Universitaria" );
		$direccionTrabajo->setCalleSecundaria ( "Av. America" );
		$direccionTrabajo->setNumero ( "N44-223" );
		$direccionTrabajo->setReferencia ( "Universidad Central" );
		$actorDireccion->setDireccionTrabajo ( $direccionTrabajo );
		
		$actor = new Actor ();
		$actor->setIdentificacion ( "1713848172" );
		$actor->setNombres ( "Diego Torres" );
		$actor->setTelefono ( "0998746548" );
		$actor->setEmail ( "cesarivanleon@gmail.com" );
		$actor->setIdentificacionContacto ( "1744332211" );
		$actor->setNombresContacto ( "Alejandro Lopez" );
		$actor->setCargoContacto ( "Gerente" );
		$actor->setEmailContacto ( "alejandro.lopez@entidad.com" );
		$actor->setFechaNacimiento ( new \DateTime ( "21-11-1990" ) ); // dd-mm-aaaa
		$actor->setSexo ( "Hombre" );
		$actor->setGenero ( "Masculino" );
		$actor->setNacionalidad ( "Ecuatoriano" );
		$actor->setInterculturalidad ( "Mestizo" );
		$actor->setLugarTrabajo ( "Trabajo" );
		$actor->setInstitucion ( "Institucion" );
		$actor->setCapacidadEspecial ( false );
		$actor->setRelacion ( "Vecino" );
		$actor->setTipo ( "Persona" );
		$actorDireccion->setActor ( $actor );
		
		$em = $this->getDoctrine ()->getManager ();
		
		$denuncias = $em->getRepository ( 'AppBundle:Denuncia' )->findAll ();
		
		if (! empty ( $denuncias )) {
			$denuncia = $denuncias [array_rand ( $denuncias )];
		} else {
			$denuncia = new Denuncia ();
			$denuncia->setCreacion ( new \DateTime ( date ( "d-m-Y" ) ) );
			$denuncia->setHechos ( "Los hechos fueron estos y estos ........" );
		}
		$actorDireccion->setDenuncia ( $denuncia );
		
		// tells Doctrine you want to (eventually) save the Product (no queries yet)
		$em->persist ( $actorDireccion );
		
		// actually executes the queries (i.e. the INSERT query)
		$em->flush ();
		
		return $this->redirectToRoute ( "listar_entidad", array (
				"nombreEntidad" => "actorDireccion",
				"mensaje" => "Actor Direccion de prueba guardado con id: " . $actorDireccion->getId () 
		) );
	}
}
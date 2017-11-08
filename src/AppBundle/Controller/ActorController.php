<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Actor;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\ConstantesDeRolActor;
use AppBundle\Entity\ActividadEconomica;

class ActorController extends Controller {
	/**
	 * @Route("/actor/actor", name="prueba_actor")
	 */
	public function createAction() {
		$actor = new Actor ();
		$actor->setIdentificacion ( "1713848172" );
		$actor->setNombres ( "Cesar Leon" );
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
		
		$em = $this->getDoctrine ()->getManager ();
		
		$actividadesEconomicas = $em->getRepository ( 'AppBundle:ActividadEconomica' )->findAll ();
		
		if (! empty ( $actividadesEconomicas )) {
			$actividadEconomica = $actividadesEconomicas [array_rand ( $actividadesEconomicas )];
		} else {
			$actividadEconomica = new ActividadEconomica ();
			$actividadEconomica->setNombre ( "Abogado" );
		}
		$actor->setActividadEconomica($actividadEconomica);		
		
		// tells Doctrine you want to (eventually) save the Product (no queries yet)
		$em->persist ( $actor );
		
		// actually executes the queries (i.e. the INSERT query)
		$em->flush ();
		
		return $this->redirectToRoute ( "listar_entidad", array (
				"nombreEntidad" => "actor",
				"mensaje" => "Actor de prueba guardada con id: " . $actor->getId () 
		) );
	}
}
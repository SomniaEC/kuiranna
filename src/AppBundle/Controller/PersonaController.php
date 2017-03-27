<?php

namespace AppBundle\Controller;

use AppBundle\ConstantesDeOperaciones;
use AppBundle\Entity\Persona;
use AppBundle\Form\PersonaType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PersonaController extends Controller {
	/**
	 * @Route("/persona/prueba")
	 */
	public function createAction() {
		$persona = new Persona ();
		$persona->setCedula ( "1713848172" );
		$persona->setEmail ( "cesarivanleon@gmail.com" );
		$persona->setFechaNacimiento ( new \DateTime ( "21-11-1990" ) ); // dd-mm-aaaa
		$persona->setNacionalidad ( "Ecuatoriano" );
		$persona->setTelefono ( "0998746548" );
		$persona->setNombres ( "César León" );
		
		$em = $this->getDoctrine ()->getManager ();
		
		// tells Doctrine you want to (eventually) save the Product (no queries yet)
		$em->persist ( $persona );
		
		// actually executes the queries (i.e. the INSERT query)
		$em->flush ();
		
		return new Response ( 'Saved new persona with id ' . $persona->getId () );
	}
	
	/**
	 * @Route("/persona/guardar", name="guardar_persona")
	 */
	public function guardarPersonaAction(Request $request) {
		// 1) build the form
		$idPersona = $request->query->get ( 'id' );
		if ($idPersona == null) {
			$persona = new Persona ();
			$mensaje = " creada correctamente";
		} else {
			$em = $this->getDoctrine ()->getManager ();
			$persona = $em->getRepository ( 'AppBundle:Persona' )->find ( $idPersona );
			$mensaje = " modificada correctamente";
		}
		
		$form = $this->createForm ( PersonaType::class, $persona );
		
		// 2) handle the submit (will only happen on POST)
		$form->handleRequest ( $request );
		if ($form->isSubmitted () && $form->isValid ()) {
			
			// 4) save the User!
			$em = $this->getDoctrine ()->getManager ();
			$em->persist ( $persona );
			$em->flush ();
			
			// ... do any other work - like sending them an email, etc
			// maybe set a "flash" success message for the user
			$mensaje = "Persona ".$persona->getNombres().$mensaje;
			return $this->redirectToRoute ( 'listar_persona', array("mensaje" => $mensaje));
		}
		
		return $this->render ( 'persona/persona.html.twig', array (
				'form' => $form->createView (),
				'operacion' => ConstantesDeOperaciones::CREAR
		) );
	}
	
	/**
	 * @Route("/persona/listar", name="listar_persona")
	 */
	public function listarPersonaAction(Request $request) {
		$em = $this->getDoctrine ()->getManager ();
		$mensaje = $request->query->get ( 'mensaje' );
		$personas = $em->getRepository ( 'AppBundle:Persona' )->findAll ();
		return $this->render ( 'entidadBase/listarEntidad.html.twig', array_merge ( array (
				'entidades' => $personas,
				'mensaje' => $mensaje 
		), Persona::getRutas () ) );
	}
	
	/**
	 * @Route("/persona/eliminar", name="eliminar_persona")
	 */
	public function eliminarPersonaAction(Request $request) {
		$idPersona = $request->query->get ( 'id' );
		
		$em = $this->getDoctrine ()->getManager ();
		$persona = $em->getRepository ( 'AppBundle:Persona' )->find ( $idPersona );
		$em->remove ( $persona );
		$em->flush ();
		
		return $this->redirectToRoute ( "listar_persona", array (
				"mensaje" => "Eliminación correcta" 
		) );
	}
	
	/**
	 * @Route("/persona/mostrar", name="mostrar_persona")
	 */
	public function mostrarPersonaAction(Request $request) {
		$idPersona = $request->query->get ( 'id' );
		
		$em = $this->getDoctrine ()->getManager ();
		
		$persona = $em->getRepository ( 'AppBundle:Persona' )->find ( $idPersona );
		
		$form = $this->createForm ( PersonaType::class, $persona );
		
		return $this->render ( 'persona/persona.html.twig', array (
				'form' => $form->createView () 
		) );
	}
}
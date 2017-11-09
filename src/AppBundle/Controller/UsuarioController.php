<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Usuario;
use AppBundle\Form\UsuarioType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UsuarioController extends Controller {
	/**
	 * @Route("/usuario/prueba", name="prueba_usuario")
	 */
	public function createAction() {
		$usuario = new Usuario ();
		$usuario->setCedula ( "1713848172" );
		
		$em = $this->getDoctrine ()->getManager ();
		
		// tells Doctrine you want to (eventually) save the Product (no queries yet)
		$em->persist ( $usuario );
		
		// actually executes the queries (i.e. the INSERT query)
		$em->flush ();
		
		return $this->redirectToRoute ( "listar_entidad", array (
				"nombreEntidad" => "usuario",
				"mensaje" => "Vulnerado de prueba guardada con id: " . $usuario->getId () 
		) );
	}
	
	/**
	 * @Route("/registrarUsuario", name="registrar_usuario")
	 */
	public function registerAction(Request $request, UserPasswordEncoderInterface $passwordEncoder) {
		// 1) build the form
		$user = new Usuario ();
		$form = $this->createForm ( UsuarioType::class, $user );
		
		// 2) handle the submit (will only happen on POST)
		$form->handleRequest ( $request );
		if ($form->isSubmitted () && $form->isValid ()) {
			
			// 3) Encode the password (you could also do this via Doctrine listener)
			$password = $passwordEncoder->encodePassword ( $user, $user->getPlainPassword () );
			$user->setPassword ( $password );
			
			// 4) save the User!
			$em = $this->getDoctrine ()->getManager ();
			$em->persist ( $user );
			$em->flush ();
			
			// ... do any other work - like sending them an email, etc
			// maybe set a "flash" success message for the user
			
			return $this->redirectToRoute ( 'listar_entidad', array (
					"nombreEntidad" => $nombreEntidad,
					"mensaje" => $mensaje 
			) );
		}
		
		return $this->render ( $nombreEntidad . '/' . $nombreEntidad . '.html.twig', array (
				'form' => $form->createView (),
				'nombreEntidad' => $nombreEntidad,
				'operacion' => ConstantesDeOperaciones::CREAR 
		) );
	}
}
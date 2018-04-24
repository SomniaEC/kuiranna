<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Junta;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Direccion;
use AppBundle\Utils\ConstantesDeOperaciones;
use Symfony\Component\HttpFoundation\Request;

class JuntaController extends Controller {
	
	/**
	 * @Route("/junta/prueba", name="prueba_junta")
	 */
	public function createAction() {
		$junta = new Junta ();
		$junta->setNombre ( 'Quito Norte' );
		$junta->setRuc ( '1706432359' );
		$junta->setTelefono ( '022243244' );
		$junta->setEmail ( '123@abc.com' );
		$junta->setLogo ( '\home\images\logo.png' );
		
		$direccion = new Direccion ();
		$direccion->setProvincia ( "Pichincha" );
		$direccion->setCanton ( "Quito" );
		$direccion->setParroquia ( "Floresta" );
		$direccion->setSector ( "Plaza Artigas" );
		$direccion->setZona ( "Centro-Norte" );
		$direccion->setCallePrincipal ( "Av. La Coruna" );
		$direccion->setCalleSecundaria ( "Av. 12 de Octubre" );
		$direccion->setNumero ( "N24-564" );
		$direccion->setReferencia ( "junta" );
		
		$junta->setDireccion ( $direccion );
		
		$em = $this->getDoctrine ()->getManager ();
		
		$em->persist ( $junta );
		
		$em->flush ();
		
		return $this->redirectToRoute ( "listar_entidad", array (
				"nombreEntidad" => "junta",
				"mensaje" => "Junta de prueba con direccion guardada con id: " . $junta->getId () 
		) );
	}
	
	/**
	 * @Route("junta/crear", name="crear_junta")
	 */
	public function crearJunta(Request $request) {
		$operacion = ConstantesDeOperaciones::CREAR;
		$entidad = new Junta ();
		$mensaje = "Junta creada correctamente";
		$form = $this->createForm ( 'AppBundle\Form\\JuntaType', $entidad );
		
		// 2) handle the submit (will only happen on POST)
		$form->handleRequest ( $request );
		if ($form->isSubmitted () && $form->isValid ()) {
			// save junta
			$em = $this->getDoctrine ()->getManager ();
			$em->persist ( $entidad );
			$em->flush ();
			
			// handle file
			$file = $form ['logo_img']->getData ();
			
			if (null !== $file) {
				$jid = $entidad->getId ();
				// try to guess the extension (more secure)
				$extension = $file->guessExtension ();
				if (! $extension) {
					// extension cannot be guessed
					$extension = 'bin';
				}
				$filename = $jid . '.' . $extension;
				$file->move ( 'content/junta', $filename );
				$entidad->setLogo ( $filename );
				$em->merge ( $entidad );
				$em->flush ();
			}
			
			// ... do any other work - like sending them an email, etc
			// maybe set a "flash" success message for the user
			return $this->redirectToRoute ( 'listar_entidad', array (
					"nombreEntidad" => 'junta',
					"mensaje" => $mensaje 
			) );
		}
		
		return $this->render ( 'junta/junta.html.twig', array (
				'form' => $form->createView (),
				'nombreEntidad' => 'junta',
				'operacion' => $operacion 
		) );
	}
	
	/**
	 * @Route("junta/modificar", name="modificar_junta")
	 */
	public function modificarJunta(Request $request) {
		// 1) build the form
		$idEntidad = $request->query->get ( 'id' );
		
		$operacion = ConstantesDeOperaciones::MODIFICAR;
		$em = $this->getDoctrine ()->getManager ();
		$entidad = $em->getRepository ( 'AppBundle:Junta' )->find ( $idEntidad );
		$mensaje = "Junta modificada correctamente";
		$form = $this->createForm ( 'AppBundle\Form\\JuntaType', $entidad );
		
		// 2) handle the submit (will only happen on POST)
		$form->handleRequest ( $request );
		if ($form->isSubmitted () && $form->isValid ()) {
			// save junta
			$em = $this->getDoctrine ()->getManager ();
			$em->persist ( $entidad );
			$em->flush ();
			
			// handle file
			$file = $form ['logo_img']->getData ();
			
			if (null !== $file) {
				$jid = $entidad->getId ();
				// try to guess the extension (more secure)
				$extension = $file->guessExtension ();
				if (! $extension) {
					// extension cannot be guessed
					$extension = 'bin';
				}
				$filename = $jid . '.' . $extension;
				$file->move ( 'content/junta', $filename );
				$entidad->setLogo ( $filename );
				$em->merge ( $entidad );
				$em->flush ();
			}
			
			// ... do any other work - like sending them an email, etc
			// maybe set a "flash" success message for the user
			return $this->redirectToRoute ( 'listar_entidad', array (
					"nombreEntidad" => 'junta',
					"mensaje" => $mensaje 
			) );
		}
		
		return $this->render ( 'junta/junta.html.twig', array (
				'form' => $form->createView (),
				'nombreEntidad' => 'junta',
				'operacion' => $operacion 
		) );
	}
}
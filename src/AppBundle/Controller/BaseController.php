<?php

namespace AppBundle\Controller;

use AppBundle\ConstantesDeOperaciones;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Actor;

class BaseController extends Controller {
	
	/**
	 * @Route("/{nombreEntidad}/listar", name="listar_entidad")
	 */
	public function listarEntidadAction(Request $request, $nombreEntidad) {
		$em = $this->getDoctrine ()->getManager ();
		$mensaje = $request->query->get ( 'mensaje' );
		$className = "AppBundle\Entity\\" . ucfirst ( $nombreEntidad );
		$entidades = $em->getRepository ( 'AppBundle:' . ucfirst ( $nombreEntidad ) )->findAll ();
		return $this->render ( 'entidadBase/listarEntidad.html.twig', array_merge ( array (
				'cabeceras' => $className::getMostrarCabeceras (),
				'entidades' => $entidades,
				'nombreEntidad' => $nombreEntidad,
				'mensaje' => $mensaje 
		), Actor::getRutas () ) );
	}
	
	/**
	 * @Route("/{nombreEntidad}/eliminar", name="eliminar_entidad")
	 */
	public function eliminarEntidadAction(Request $request, $nombreEntidad) {
		$idEntidad = $request->query->get ( 'id' );
		
		$em = $this->getDoctrine ()->getManager ();
		$entidad = $em->getRepository ( 'AppBundle:' . ucfirst ( $nombreEntidad ) )->find ( $idEntidad );
		$em->remove ( $entidad );
		$em->flush ();
		
		return $this->redirectToRoute ( "listar_entidad", array (
				"nombreEntidad" => $nombreEntidad,
				"mensaje" => "Eliminacion correcta" 
		) );
	}
	
	/**
	 * @Route("/{nombreEntidad}/mostrar", name="mostrar_entidad")
	 */
	public function mostrarEntidadAction(Request $request, $nombreEntidad) {
		$idEntidad = $request->query->get ( 'id' );
		
		$em = $this->getDoctrine ()->getManager ();
		
		$entidad = $em->getRepository ( 'AppBundle:' . ucfirst ( $nombreEntidad ) )->find ( $idEntidad );
		
		$form = $this->createForm ( 'AppBundle\Form\\' . ucfirst ( $nombreEntidad ) . 'Type', $entidad );
		
		return $this->render ( $nombreEntidad . '/' . $nombreEntidad . '.html.twig', array (
				'form' => $form->createView (),
				'nombreEntidad' => $nombreEntidad 
		) );
	}
	
	/**
	 * @Route("{nombreEntidad}/guardar", name="guardar_entidad", 
	 * requirements={"nombreEntidad" : "actor|direccion|centroEducativo|derecho|vulnerado|junta|actorDireccion|vulneradoDireccion|archivo|actividadEconomica|plantilla|operacionDenuncia|auditoria|provincia|canton|parroquia|domicilio|usuario|persona"})
	 */
	public function guardarEntidadAction(Request $request, $nombreEntidad) {
		// 1) build the form
		$idEntidad = $request->query->get ( 'id' );
		if ($idEntidad == null) {
			$className = "AppBundle\Entity\\" . ucfirst ( $nombreEntidad );
			$entidad = new $className ();
			$mensaje = ucfirst ( $nombreEntidad ) . " creada correctamente";
		} else {
			$em = $this->getDoctrine ()->getManager ();
			$entidad = $em->getRepository ( 'AppBundle:' . ucfirst ( $nombreEntidad ) )->find ( $idEntidad );
			$mensaje = ucfirst ( $nombreEntidad ) . " modificada correctamente";
		}
		
		$form = $this->createForm ( 'AppBundle\Form\\' . ucfirst ( $nombreEntidad ) . 'Type', $entidad );
		
		// 2) handle the submit (will only happen on POST)
		$form->handleRequest ( $request );
		if ($form->isSubmitted () && $form->isValid ()) {
			
			// 4) save the User!
			$em = $this->getDoctrine ()->getManager ();
			$em->persist ( $entidad );
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
	
	/**
	 * @Route("{nombreEntidad}/guardartodo", name="guardar_entidad_todo")
	 */
	public function guardarEntidadTodoAction(Request $request, $nombreEntidad) {
		// 1) build the form
		$idEntidad = $request->query->get ( 'id' );
		if ($idEntidad == null) {
			$className = "AppBundle\Entity\\" . ucfirst ( $nombreEntidad );
			$entidad = new $className ();
			$mensaje = ucfirst ( $nombreEntidad ) . " creada correctamente";
		} else {
			$em = $this->getDoctrine ()->getManager ();
			$entidad = $em->getRepository ( 'AppBundle:' . ucfirst ( $nombreEntidad ) )->find ( $idEntidad );
			$mensaje = ucfirst ( $nombreEntidad ) . " modificada correctamente";
		}
		
		$form = $this->createForm ( 'AppBundle\Form\\' . ucfirst ( $nombreEntidad ) . 'TodoType', $entidad );
		
		// 2) handle the submit (will only happen on POST)
		$form->handleRequest ( $request );
		if ($form->isSubmitted () && $form->isValid ()) {
			
			// 4) save the User!
			$em = $this->getDoctrine ()->getManager ();
			$em->persist ( $entidad );
			$em->flush ();
			
			// ... do any other work - like sending them an email, etc
			// maybe set a "flash" success message for the user
			return $this->redirectToRoute ( 'listar_entidad', array (
					"nombreEntidad" => $nombreEntidad,
					"mensaje" => $mensaje 
			) );
		}
		
		return $this->render ( $nombreEntidad . '/' . $nombreEntidad . '.todo.html.twig', array (
				'form' => $form->createView (),
				'nombreEntidad' => $nombreEntidad,
				'operacion' => ConstantesDeOperaciones::CREAR 
		) );
	}
}
<?php

namespace AppBundle\Controller;

use AppBundle\Entity\CentroEducativo;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Direccion;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Utils\ConstantesDeOperaciones;

class CentroEducativoController extends BaseController {
	
	private $nombre_entidad = "centroEducativo";
	
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
	
	/**
	 * @Route("centroEducativo/guardar", name="guardar_centroeducativo")
	 */
	public function guardarCentroEducativoAction(Request $request) {
		$idEntidad = $request->query->get ( 'id' );
		$em = $this->getDoctrine ()->getManager ();
		if ($idEntidad == null) {
			$operacion = ConstantesDeOperaciones::CREAR;
			$centro = new CentroEducativo ();
			$mensaje = "Centro Educativo creado correctamente";
			
			// si usuario tiene ligada una junta
			if ($request->getSession ()->get ( 'junta' ) != null) {
				$idJunta = $request->getSession ()->get ( 'junta' )->getId ();
				$junta = $em->getRepository ( 'AppBundle:Junta' )->findOneById ( $idJunta );
				$centro->setJunta ( $junta );
				$direccion = new Direccion ();
				$direccion->setProvincia ( $request->getSession ()->get ( 'junta' )->getDireccion ()->getProvincia () );
				$direccion->setCanton ( $request->getSession ()->get ( 'junta' )->getDireccion ()->getCanton () );
				$direccion->setParroquia ( $request->getSession ()->get ( 'junta' )->getDireccion ()->getParroquia () );
				$centro->setDireccion ( $direccion );
				$form = $this->createForm ($this->getCrearType($this->nombre_entidad), $centro );
			} else {
				$form = $this->createForm ($this->getCrearTodoType($this->nombre_entidad), $centro );
			}			
		} else {
			$operacion = ConstantesDeOperaciones::MODIFICAR;
			$centro = $em->getRepository ( 'AppBundle:CentroEducativo')->find ( $idEntidad );
			$mensaje = "Centro Educativo modificada correctamente";
			// si usuario tiene ligada una junta
			if ($request->getSession ()->get ( 'junta' ) != null) {
				$form = $this->createForm ($this->getModificarType($this->nombre_entidad), $centro );
			} else {
				$form = $this->createForm ($this->getCrearTodoType($this->nombre_entidad), $centro );
			}
			
		}
		
		$form->handleRequest ( $request );
		if ($form->isSubmitted () && $form->isValid ()) {
			
			$em->persist ( $centro );
			$em->flush ();
			
			return $this->redirectToRoute ( 'listar_entidad', array (
					"nombreEntidad" => $this->nombre_entidad,
					"mensaje" => $mensaje
			) );
		}
		
		if ($request->getSession ()->get ( 'junta' ) != null) {
			$view =  $this->nombre_entidad . '/' . $this->nombre_entidad . '.html.twig';
		} else {
			$view =  $this->nombre_entidad . '/' . $this->nombre_entidad . 'Todo.html.twig';
		}
		return $this->render ($view, array (
				'form' => $form->createView (),
				'nombreEntidad' => $this->nombre_entidad,
				'operacion' => $operacion 
		) );
	}
}
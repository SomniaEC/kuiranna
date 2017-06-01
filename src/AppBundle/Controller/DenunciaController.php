<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Denuncia;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\ConstantesDeOperaciones;

class DenunciaController extends Controller {
	/**
	 * @Route("/denuncia/prueba", name="prueba_denuncia")
	 */
	public function createAction() {
		$denuncia = new Denuncia ();
		$denuncia->setFechaRegistro ( new \DateTime ( date ( "d-m-Y" ) ) );
		$denuncia->setHechos ( "Denuncia presentada ........" );
		
		$em = $this->getDoctrine ()->getManager ();
		
		$derechos = $em->getRepository ( 'AppBundle:Derecho' )->findAll ();
		
		$denuncia->addDerecho( $derechos [array_rand ( $derechos )] );
		
		$em->persist ( $denuncia );
		$em->flush ();
		
		return $this->redirectToRoute ( "listar_entidad", array (
				"nombreEntidad" => "denuncia",
				"mensaje" => "Denuncia de prueba guardada con id: " . $denuncia->getId () 
		) );
	}
	
	/**
	 * @Route("denuncia/guardartodo", name="guardar_denuncia_todo")
	 */
	public function guardarEntidadAction(Request $request) {
		// 1) build the form
		$idEntidad = $request->query->get ( 'id' );
		if ($idEntidad == null) {
			$entidad = new Denuncia();
			$mensaje = "Denuncia creada correctamente";
		} else {
			$em = $this->getDoctrine ()->getManager ();
			$entidad = $em->getRepository ( 'AppBundle:Denuncia' )->find ( $idEntidad );
			$mensaje = "Denuncia modificada correctamente";
		}
		$form = $this->createForm ( 'AppBundle\Form\DenunciaTodoType', $entidad );
	
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
					"nombreEntidad" => "denuncia",
					"mensaje" => $mensaje
			) );
		}
	
		return $this->render ( 'denuncia/denuncia.todo.html.twig', array (
				'form' => $form->createView (),
				'nombreEntidad' => 'denuncia',
				'operacion' => ConstantesDeOperaciones::CREAR
		) );
	}
}
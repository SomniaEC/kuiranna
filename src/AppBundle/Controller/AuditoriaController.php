<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Auditoria;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AuditoriaController extends Controller {
	/**
	 * @Route("/auditoria/prueba", name="prueba_auditoria")
	 */
	public function createAction() {
		$auditoria = new Auditoria ();
		$auditoria->setModulo ( "denuncia" );
		$auditoria->setAccion ( "crear" );
		$auditoria->setFechaHora ( new \DateTime ( date ( "d-m-Y" ) ) );
		$auditoria->setIp ( "192.168.0.100" );
		
		$em = $this->getDoctrine ()->getManager ();
		$em->persist ( $auditoria );
		$em->flush ();
		
		return $this->redirectToRoute ( "listar_entidad", array (
				"nombreEntidad" => "auditoria",
				"mensaje" => "Auditoria de prueba guardado con id: " . $auditoria->getId () 
		) );
	}
}
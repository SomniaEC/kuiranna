<?php

namespace AppBundle\Controller;

use AppBundle\Entity\CentroEducativo;
use AppBundle\Entity\Denuncia;
use AppBundle\Entity\Direccion;
use AppBundle\Entity\Vulnerado;
use AppBundle\Entity\OperacionDenuncia;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class OperacionDenunciaController extends Controller {
	/**
	 * @Route("/operacionDenuncia/prueba", name="prueba_operacionDenuncia")
	 */
	public function createAction() {
		$operacionDenuncia = new OperacionDenuncia ();
		$operacionDenuncia->setOperacion ( "CREACION" );
		$operacionDenuncia->setFechaHora ( new \DateTime ( date ( "d-m-Y" ) ) );
		
		$em = $this->getDoctrine ()->getManager ();
		
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
		$operacionDenuncia->setDenuncia ( $denuncia );
		
		// tells Doctrine you want to (eventually) save the Product (no queries yet)
		$em->persist ( $operacionDenuncia );
		
		// actually executes the queries (i.e. the INSERT query)
		$em->flush ();
		
		return $this->redirectToRoute ( "listar_entidad", array (
				"nombreEntidad" => "operacionDenuncia",
				"mensaje" => "Operacion Denuncia de prueba guardado con id: " . $operacionDenuncia->getId () 
		) );
	}
}
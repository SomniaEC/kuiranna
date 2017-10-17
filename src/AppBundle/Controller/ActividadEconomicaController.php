<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\ActividadEconomica;

class ActividadEconomicaController extends Controller {
	/**
	 * @Route("/actividadEconomica/prueba", name="prueba_actividadEconomica")
	 */
	public function createAction() {
		$actividadEconomica = new ActividadEconomica ();
		$actividadEconomica->setNombre ( "Carpintero" );

		$em = $this->getDoctrine ()->getManager ();
		$em->persist ( $actividadEconomica );
		$em->flush ();
		
		return $this->redirectToRoute ( "listar_entidad", array (
				"nombreEntidad" => "actividadEconomica",
				"mensaje" => "Actividad economica de prueba guardado con id: " . $actividadEconomica->getId () 
		) );
	}
}
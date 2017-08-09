<?php

namespace AppBundle\Controller;

use AppBundle\ConstantesDeOperaciones;
use AppBundle\ConstantesDeTipoPersona;
use AppBundle\Entity\Denuncia;
use AppBundle\Entity\PersonaDomicilio;
use AppBundle\Entity\VulneradoDomicilio;
use Doctrine\Common\Collections\ArrayCollection;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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
		
		$denuncia->addDerecho ( $derechos [array_rand ( $derechos )] );
		
		$em->persist ( $denuncia );
		$em->flush ();
		
		return $this->redirectToRoute ( "listar_entidad", array (
				"nombreEntidad" => "denuncia",
				"mensaje" => "Denuncia de prueba guardada con id: " . $denuncia->getId () 
		) );
	}
	
	/**
	 * @Route("denuncia/crear", name="crear_denuncia")
	 */
	public function crearDenunciaAction(Request $request) {
		// 1) build the form
		$idEntidad = $request->query->get ( 'id' );
		if ($idEntidad == null) {
			$denuncia = new Denuncia ();
			$denunciante = new PersonaDomicilio ();
			$denunciante->setTipo ( ConstantesDeTipoPersona::DENUNCIANTE );
			$denuncia->addPersonasDomicilio ( $denunciante );
			$denunciado = new PersonaDomicilio ();
			$denunciado->setTipo ( ConstantesDeTipoPersona::DENUNCIADO );
			$denuncia->addPersonasDomicilio ( $denunciado );
			$vulnerado = new VulneradoDomicilio ();
			$denuncia->addVulneradosDomicilio ( $vulnerado );
			$mensaje = "Denuncia creada correctamente";
		} else {
			$em = $this->getDoctrine ()->getManager ();
			$denuncia = $em->getRepository ( 'AppBundle:Denuncia' )->find ( $idEntidad );
			$mensaje = "Denuncia modificada correctamente";
		}
		
		$originalPDomicilios = new ArrayCollection ();
		$originalVulnerados = new ArrayCollection ();
		
		// Create an ArrayCollection of the current pDomicilios objects in the database
		foreach ( $denuncia->getPersonasDomicilio () as $pDomicilio ) {
			$originalPDomicilios->add ( $pDomicilio );
		}
		
		// Create an ArrayCollection of the current vulnerados objects in the database
		foreach ( $denuncia->getVulneradosDomicilio () as $vulnerado ) {
			$originalVulnerados->add ( $vulnerado );
		}
		
		$form = $this->createForm ( 'AppBundle\Form\\DenunciaType', $denuncia );
		
		// 2) handle the submit (will only happen on POST)
		$form->handleRequest ( $request );
		if ($form->isSubmitted () && $form->isValid ()) {
			
			// 4) save the User!
			$em = $this->getDoctrine ()->getManager ();
			foreach ( $denuncia->getPersonasDomicilio () as $pDomicilio ) {
				$pDomicilio->setDenuncia ( $denuncia );
				$pDomicilio->setJunta ( $denuncia->getJunta () );
			}
			foreach ( $denuncia->getVulneradosDomicilio () as $vulnerado ) {
				$vulnerado->setDenuncia ( $denuncia );
				$vulnerado->setJunta ( $denuncia->getJunta () );
			}
			foreach ( $originalPDomicilios as $pDomicilio ) {
				if (false === $denuncia->getPersonasDomicilio ()->contains ( $pDomicilio )) {
					$em->remove ( $pDomicilio );
				}
			}
			foreach ( $originalVulnerados as $vulnerado ) {
				if (false === $denuncia->getVulneradosDomicilio ()->contains ( $vulnerado )) {
					$em->remove ( $vulnerado );
				}
			}
			$em->persist ( $denuncia );
			$em->flush ();
			
			// ... do any other work - like sending them an email, etc
			// maybe set a "flash" success message for the user
			return $this->redirectToRoute ( 'listar_entidad', array (
					"nombreEntidad" => "denuncia",
					"mensaje" => $mensaje 
			) );
		}
		
		return $this->render ( 'denuncia/denuncia.html.twig', array (
				'form' => $form->createView (),
				'nombreEntidad' => 'denuncia',
				'operacion' => ConstantesDeOperaciones::CREAR 
		) );
	}
}
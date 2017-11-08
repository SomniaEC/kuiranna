<?php

namespace AppBundle\Controller;

use AppBundle\ConstantesDeOperaciones;
use AppBundle\ConstantesDeRolActor;
use AppBundle\Entity\Denuncia;
use AppBundle\Entity\ActorDireccion;
use AppBundle\Entity\VulneradoDireccion;
use Doctrine\Common\Collections\ArrayCollection;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Derecho;

class DenunciaController extends Controller {
	/**
	 * @Route("/denuncia/prueba", name="prueba_denuncia")
	 */
	public function createAction() {
		$denuncia = new Denuncia ();
		$denuncia->setCreacion ( new \DateTime ( date ( "d-m-Y" ) ) );
		$denuncia->setHechos ( "Denuncia presentada ........" );
		$denuncia->setRecursoImpugnacion ( "Reposicion" );
		$denuncia->setTipoMaltrato ( "Trabajo Infantil" );
		$denuncia->setAmbitoMaltrato ( "Familiar" );
		$denuncia->setVulneradoresDerechos ( "Madre;Padre" );
		
		$em = $this->getDoctrine ()->getManager ();
		
		$derechos = $em->getRepository ( 'AppBundle:Derecho' )->findAll ();
		
		if (! empty ( $derechos )) {
			$derecho = $derechos [array_rand ( $derechos )];
		} else {
			$derecho = new Derecho ();
			$derecho->setTipo ( "DERECHOS DE SUPERVIVENCIA" );
			$derecho->setNombre ( "Art. 21" );
			$derecho->setDescripcion ( "Derecho a conocer a los progenitores y a mantener relaciones con ellos" );
		}
		
		$denuncia->addDerecho ( $derecho );
		
		$em->persist ( $denuncia );
		$em->flush ();
		
		return $this->redirectToRoute ( "listar_entidad", array (
				"nombreEntidad" => "denuncia",
				"mensaje" => "Denuncia de prueba guardada con id: " . $denuncia->getId () 
		) );
	}
	
	/**
	 * @Route("denuncia/guardar", name="guardar_denuncia")
	 */
	public function crearDenunciaAction(Request $request) {
		// 1) build the form
		$idEntidad = $request->query->get ( 'id' );
		if ($idEntidad == null) {
			$denuncia = new Denuncia ();
			$denuncia->setCreacion ( new \DateTime ( date ( "d-m-Y" ) ) );
			$denunciante = new ActorDireccion ();
			$denunciante->setRol ( ConstantesDeRolActor::DENUNCIANTE );
			$denuncia->addActoresDireccion ( $denunciante );
			$denunciado = new ActorDireccion ();
			$denunciado->setRol ( ConstantesDeRolActor::DENUNCIADO );
			$denuncia->addActoresDireccion ( $denunciado );
			$vulnerado = new VulneradoDireccion ();
			$denuncia->addVulneradosDireccion ( $vulnerado );
			$mensaje = "Denuncia creada correctamente";
		} else {
			$em = $this->getDoctrine ()->getManager ();
			$denuncia = $em->getRepository ( 'AppBundle:Denuncia' )->find ( $idEntidad );
			$mensaje = "Denuncia modificada correctamente";
		}
		
		$originalPDireccions = new ArrayCollection ();
		$originalVulnerados = new ArrayCollection ();
		
		// Create an ArrayCollection of the current pDireccions objects in the database
		foreach ( $denuncia->getActoresDireccion () as $pDireccion ) {
			$originalPDireccions->add ( $pDireccion );
		}
		
		// Create an ArrayCollection of the current vulnerados objects in the database
		foreach ( $denuncia->getVulneradosDireccion () as $vulnerado ) {
			$originalVulnerados->add ( $vulnerado );
		}
		
		$form = $this->createForm ( 'AppBundle\Form\\DenunciaType', $denuncia );
		
		// 2) handle the submit (will only happen on POST)
		$form->handleRequest ( $request );
		if ($form->isSubmitted () && $form->isValid ()) {
			
			// 4) save the User!
			$em = $this->getDoctrine ()->getManager ();
			foreach ( $denuncia->getActoresDireccion () as $pDireccion ) {
				$pDireccion->setDenuncia ( $denuncia );
				$pDireccion->setJunta ( $denuncia->getJunta () );
			}
			foreach ( $denuncia->getVulneradosDireccion () as $vulnerado ) {
				$vulnerado->setDenuncia ( $denuncia );
				$vulnerado->setJunta ( $denuncia->getJunta () );
			}
			foreach ( $originalPDireccions as $pDireccion ) {
				if (false === $denuncia->getActoresDireccion ()->contains ( $pDireccion )) {
					$em->remove ( $pDireccion );
				}
			}
			foreach ( $originalVulnerados as $vulnerado ) {
				if (false === $denuncia->getVulneradosDireccion ()->contains ( $vulnerado )) {
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
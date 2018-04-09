<?php

namespace AppBundle\Controller;

use AppBundle\Utils\ConstantesDeOperaciones;
use AppBundle\Utils\ConstantesDeRolActor;
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
		$em = $this->getDoctrine ()->getManager ();
		$junta = $request->getSession ()->get ( 'junta' );
		$idEntidad = $request->query->get ( 'id' );
		if ($idEntidad == null) {
			$denuncia = new Denuncia ();
			$denuncia->setCreacion ( new \DateTime ( date ( "d-m-Y" ) ) );
			$denunciante = new ActorDireccion ();
			$denunciante->setRol ( ConstantesDeRolActor::Denunciante );
			$denuncia->addActoresDireccion ( $denunciante );
			$denunciado = new ActorDireccion ();
			$denunciado->setRol ( ConstantesDeRolActor::Denunciado );
			$denuncia->addActoresDireccion ( $denunciado );
			$vulnerado = new VulneradoDireccion ();
			$denuncia->addVulneradosDireccion ( $vulnerado );
			$mensaje = "Denuncia creada correctamente";
			
			// si usuario tiene ligada una junta
			if ($junta != null) {
				$idJunta = $request->getSession ()->get ( 'junta' )->getId ();
				$entidad = $em->getRepository ( 'AppBundle:Junta' )->findOneById ( $idJunta );
				$denuncia->setJunta ( $entidad );
			}
		} else {
			$denuncia = $em->getRepository ( 'AppBundle:Denuncia' )->find ( $idEntidad );
			$mensaje = "Denuncia modificada correctamente";
		}
		
		$originalActores = new ArrayCollection ();
		$originalVulnerados = new ArrayCollection ();
		
		// Create an ArrayCollection of the current pDireccions objects in the database
		foreach ( $denuncia->getActoresDireccion () as $actor ) {
			$originalActores->add ( $actor );
		}
		
		// Create an ArrayCollection of the current vulnerados objects in the database
		foreach ( $denuncia->getVulneradosDireccion () as $vulnerado ) {
			$originalVulnerados->add ( $vulnerado );
		}
		
		if($junta != null) {
			$form = $this->createForm ( 'AppBundle\Form\\DenunciaType', $denuncia );
		} else {
			$form = $this->createForm ( 'AppBundle\Form\\DenunciaTodoType', $denuncia );
		}
		
		// 2) handle the submit (will only happen on POST)
		$form->handleRequest ( $request );
		if ($form->isSubmitted () && $form->isValid ()) {
			
			// 4) save the User!
			$em = $this->getDoctrine ()->getManager ();
			foreach ( $denuncia->getActoresDireccion () as $actor ) {
				$actor->setDenuncia ( $denuncia );
				$actor->setJunta ( $denuncia->getJunta () );
			}
			foreach ( $denuncia->getVulneradosDireccion () as $vulnerado ) {
				$vulnerado->setDenuncia ( $denuncia );
				$vulnerado->setJunta ( $denuncia->getJunta () );
			}
			foreach ( $originalActores as $actor ) {
				if (false === $denuncia->getActoresDireccion ()->contains ( $actor )) {
					$em->remove ( $actor );
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
		
		if($junta != null) {
			$view = 'denuncia/denuncia.html.twig';
		} else {
			$view = 'denuncia/denunciaTodo.html.twig';
		}
		return $this->render ( $view, array (
				'form' => $form->createView (),
				'nombreEntidad' => 'denuncia',
				'operacion' => ConstantesDeOperaciones::CREAR 
		) );
	}
}
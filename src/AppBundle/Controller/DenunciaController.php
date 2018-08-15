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
use AppBundle\Utils\SequenceManager;
use AppBundle\Entity\Junta;
use Doctrine\ORM\EntityManager;
use AppBundle\Entity\Provincia;
use AppBundle\Entity\Canton;
use AppBundle\Entity\Parroquia;
use AppBundle\Entity\Vulnerado;
use AppBundle\Entity\CentroEducativo;
use AppBundle\Entity\Direccion;
use AppBundle\Utils\ConstantesDeRolUsuario;
use AppBundle\Utils\ConstantesDeEstadoDenuncia;

class DenunciaController extends Controller {
	/**
	 * @Route("/denuncia/prueba", name="prueba_denuncia")
	 */
	public function createAction() {
		$denuncia = new Denuncia ();
		
		$denuncia->setCreacion ( new \DateTime (  ) );
		$denuncia->setHechos ( "Denuncia presentada ........" );
		$denuncia->setTipoMaltrato ( "Trabajo Infantil" );
		$denuncia->setAmbitoMaltrato ( "Familiar" );
		$denuncia->setVulneradoresDerechos ( ["Madre", "Padre"] );
		
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
		$vulnerado = $this->createVulnerado();
		$denuncia->addVulneradosDireccion($vulnerado);
		$vulnerado->setDenuncia($denuncia);

		$denunciante = new ActorDireccion ();
		$denunciante->setRol ( ConstantesDeRolActor::Denunciante );
		$denunciante->setDenuncia($denuncia);
		$denuncia->addActoresDireccion ( $denunciante );
		$denunciado = new ActorDireccion ();
		$denunciado->setRol ( ConstantesDeRolActor::Denunciado );
		$denuncia->addActoresDireccion ( $denunciado );
		$denunciado->setDenuncia($denuncia);
		
		if($this->getUser()->getJunta() != null) {
			$junta = $this->getUser()->getJunta();
		} else {
			$juntas = $em->getRepository ( 'AppBundle:Junta' )->findAll ();
			$junta = $juntas [array_rand ( $juntas )];
		}
		if ($junta != null) {
			$fecha = new \DateTime ( date ( "d-m-Y" ) );
			
			//codigo denuncia
			$sequenceManager = $this->container->get('app.sequence_manager');
			/* @var $provincia Provincia */
			$provincia = $em->getRepository ( 'AppBundle:Provincia' )->findOneBy ( array ( 'nombre' => $junta->getDireccion()->getProvincia() ) );
			/* @var $canton Canton */
			$canton = $em->getRepository ( 'AppBundle:Canton' )->findOneBy ( array ( 'nombre' => $junta->getDireccion()->getCanton() ) );
			/* @var $parroquia Parroquia */
			$parroquia = $em->getRepository ( 'AppBundle:Parroquia' )->findOneBy ( array ( 'nombre' => $junta->getDireccion()->getParroquia() ) );
			/* @var $sequenceManager SequenceManager */
			$secuencia = $sequenceManager-> getNext($provincia->getCodigo() . $canton->getCodigo() . $parroquia->getCodigo() . $fecha->format('Y'), 1);
			$codigo = $provincia->getCodigo() . $canton->getCodigo() . $parroquia->getCodigo() . '-' . str_pad($secuencia, 5, '0', STR_PAD_LEFT) . '-' . $fecha->format('Y');
            $denuncia->setNumeroCaso($codigo);
            $denuncia->setJunta($junta);
            $denunciante->setJunta($junta);
            $denunciado->setJunta($junta);
        } else {
            $secuencia = $sequenceManager->getNext('010101' . $fecha->format('Y'), 1);
            $denuncia->setNumeroCaso('010101' . '-' . str_pad($secuencia, 5, '0', STR_PAD_LEFT) . '-' . $fecha->format('Y'));
        }
        
        $em->persist($denuncia);
        $em->flush();
        
        return $this->redirectToRoute("listar_entidad", array(
            "nombreEntidad" => "denuncia",
            "mensaje" => "Denuncia de prueba guardada con id: " . $denuncia->getId()
        ));
    }

    /**
     * @Route("denuncia/crear", name="crear_denuncia")
     */
    public function crearDenunciaAction(Request $request)
    {
    	$rol = $request->getSession ()->get ( 'user_rol' );
        $em = $this->getDoctrine()->getManager();
        $junta = $request->getSession()->get('junta');
        $denuncia = new Denuncia();
        $denuncia->setCreacion(new \DateTime());
        $denunciante = new ActorDireccion();
        $denunciante->setRol(ConstantesDeRolActor::Denunciante);
        $denuncia->addActoresDireccion($denunciante);
        $denunciado = new ActorDireccion();
        $denunciado->setRol(ConstantesDeRolActor::Denunciado);
        $denuncia->addActoresDireccion($denunciado);
        $vulnerado = new VulneradoDireccion();
        $denuncia->addVulneradosDireccion($vulnerado);
        $mensaje = "Denuncia creada correctamente";
        
        // si usuario tiene ligada una junta
        if ($junta != null) {
            $idJunta = $request->getSession()
                ->get('junta')
                ->getId();
            $entidad = $em->getRepository('AppBundle:Junta')->findOneById($idJunta);
            $denuncia->setJunta($entidad);
        }
        
        if ($junta != null) {
        	if($rol == ConstantesDeRolUsuario::Secretario) {
        		$form = $this->createForm('AppBundle\Form\\DenunciaSecretarioType', $denuncia, array(
        				'junta' => $junta
        		));
        	} else {
	            $form = $this->createForm('AppBundle\Form\\DenunciaType', $denuncia, array(
	                'junta' => $junta
	            ));
        	}
        } else {
            $form = $this->createForm('AppBundle\Form\\DenunciaTodoType', $denuncia, array(
                'junta' => $junta
            ));
        }
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
        	$denuncia->setEstadoOperacion(ConstantesDeEstadoDenuncia::Asignar_Miembro);
        	
            /* @var $junta Junta */
            $junta = $denuncia->getJunta();
            /* @var $em EntityManager */
            $em = $this->getDoctrine()->getManager();
            
            $fecha = new \DateTime();
            $denuncia->setCreacion($fecha);
            
            if ($denuncia->getNumeroCaso() == null) {
                // codigo denuncia
                $sequenceManager = $this->container->get('app.sequence_manager');
                /* @var $provincia Provincia */
                $provincia = $em->getRepository('AppBundle:Provincia')->findOneBy(array(
                    'nombre' => $junta->getDireccion()
                        ->getProvincia()
                ));
                /* @var $canton Canton */
                $canton = $em->getRepository('AppBundle:Canton')->findOneBy(array(
                    'nombre' => $junta->getDireccion()
                        ->getCanton()
                ));
                /* @var $parroquia Parroquia */
                $parroquia = $em->getRepository('AppBundle:Parroquia')->findOneBy(array(
                    'nombre' => $junta->getDireccion()
                        ->getParroquia()
                ));
                /* @var $sequenceManager SequenceManager */
                var_dump($provincia);
                $secuencia = $sequenceManager->getNext($provincia->getCodigo() . $canton->getCodigo() . $parroquia->getCodigo() . $fecha->format('Y'), 1);
                $codigo = $provincia->getCodigo() . $canton->getCodigo() . $parroquia->getCodigo() . '-' . str_pad($secuencia, 5, '0', STR_PAD_LEFT) . '-' . $fecha->format('Y');
                $denuncia->setNumeroCaso($codigo);
            }
            foreach ($denuncia->getActoresDireccion() as $actor) {
                $actor->setDenuncia($denuncia);
                $actor->setJunta($junta);
            }
            foreach ($denuncia->getVulneradosDireccion() as $vulnerado) {
                $vulnerado->setDenuncia($denuncia);
                $vulnerado->setJunta($junta);
            }
            
            $em->persist($denuncia);
            $em->flush();
            
            return $this->redirectToRoute('listar_entidad', array(
                "nombreEntidad" => "denuncia",
                "mensaje" => $mensaje
            ));
        }
        
        if ($junta != null) {
        	if($rol == ConstantesDeRolUsuario::Secretario) {
            	$view = 'denuncia/denunciaSecretario.html.twig';
        	} else {
        		$view = 'denuncia/denuncia.html.twig';
        	}
        } else {
            $view = 'denuncia/denunciaTodo.html.twig';
        }
        return $this->render($view, array(
            'form' => $form->createView(),
            'nombreEntidad' => 'denuncia',
            'operacion' => ConstantesDeOperaciones::CREAR
        ));
    }

    /**
     * @Route("denuncia/modificar", name="modificar_denuncia")
     */
    public function modificarDenunciaAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $junta = $request->getSession()->get('junta');
        $idEntidad = $request->query->get('id');
        $denuncia = $em->getRepository('AppBundle:Denuncia')->find($idEntidad);
        $mensaje = "Denuncia modificada correctamente";
        
        $originalActores = new ArrayCollection();
        $originalVulnerados = new ArrayCollection();
        
        // Create an ArrayCollection of the current pDireccions objects in the database
        foreach ($denuncia->getActoresDireccion() as $actor) {
            $originalActores->add($actor);
        }
        
        // Create an ArrayCollection of the current vulnerados objects in the database
        foreach ($denuncia->getVulneradosDireccion() as $vulnerado) {
            $originalVulnerados->add($vulnerado);
        }
        
        if ($junta != null) {
            $form = $this->createForm('AppBundle\Form\\DenunciaType', $denuncia, array(
                'junta' => $junta
            ));
        } else {
            $form = $this->createForm('AppBundle\Form\\DenunciaTodoType', $denuncia, array(
                'junta' => $junta
            ));
        }
        
        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
            /* @var $junta Junta */
            $junta = $denuncia->getJunta();
            /* @var $em EntityManager */
            $em = $this->getDoctrine()->getManager();
            
            if ($denuncia->getNumeroCaso() == null) {
                // codigo denuncia
                $sequenceManager = $this->container->get('app.sequence_manager');
                /* @var $provincia Provincia */
                $provincia = $em->getRepository('AppBundle:Provincia')->findOneBy(array(
                    'nombre' => $junta->getDireccion()
                        ->getProvincia()
                ));
                /* @var $canton Canton */
                $canton = $em->getRepository('AppBundle:Canton')->findOneBy(array(
                    'nombre' => $junta->getDireccion()
                        ->getCanton()
                ));
                /* @var $parroquia Parroquia */
                $parroquia = $em->getRepository('AppBundle:Parroquia')->findOneBy(array(
                    'nombre' => $junta->getDireccion()
                        ->getParroquia()
                ));
                /* @var $sequenceManager SequenceManager */
                $secuencia = $sequenceManager->getNext($provincia->getCodigo() . $canton->getCodigo() . $parroquia->getCodigo() . $fecha->format('Y'), 1);
                $codigo = $provincia->getCodigo() . $canton->getCodigo() . $parroquia->getCodigo() . '-' . str_pad($secuencia, 5, '0', STR_PAD_LEFT) . '-' . $fecha->format('Y');
                $denuncia->setNumeroCaso($codigo);
            }
            foreach ($denuncia->getActoresDireccion() as $actor) {
                $actor->setDenuncia($denuncia);
                $actor->setJunta($junta);
            }
            foreach ($denuncia->getVulneradosDireccion() as $vulnerado) {
                $vulnerado->setDenuncia($denuncia);
                $vulnerado->setJunta($junta);
            }
            foreach ($originalActores as $actor) {
                if (false === $denuncia->getActoresDireccion()->contains($actor)) {
                    $em->remove($actor);
                }
            }
            foreach ($originalVulnerados as $vulnerado) {
                if (false === $denuncia->getVulneradosDireccion()->contains($vulnerado)) {
                    $em->remove($vulnerado);
                }
            }
            
            $em->persist($denuncia );
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
	    	'operacion' => ConstantesDeOperaciones::MODIFICAR
	    ) );
	}
	
	public function createVulnerado() {
		$vulneradoDireccion = new VulneradoDireccion ();
		
		$direccion = new Direccion ();
		$direccion->setProvincia ( "Pichincha" );
		$direccion->setCanton ( "Quito" );
		$direccion->setParroquia ( "Benalcazar" );
		$direccion->setSector ( "Bellavista" );
		$direccion->setZona ( "Centro-Norte" );
		$direccion->setCallePrincipal ( "Eloy Alfaro" );
		$direccion->setCalleSecundaria ( "Catalina Aldaz" );
		$direccion->setNumero ( "N24-554" );
		$direccion->setReferencia ( "vulnerado" );
		$vulneradoDireccion->setDireccion ( $direccion );
		
		$vulnerado = new Vulnerado ();
		$vulnerado->setIdentificacion ( "1713848172" );
		$vulnerado->setNombres ( "CARLOS CARRILLO" );
		$vulnerado->setFechaNacimiento ( new \DateTime ( "21-11-1990" ) ); // dd-mm-aaaa
		$vulnerado->setSexo ( "Hombre" );
		$vulnerado->setGenero ( "Masculino" );
		$vulnerado->setNacionalidad ( "Ecuatoriano" );
		$vulnerado->setInterculturalidad ( "Mestizo" );
		$vulnerado->setOcupacion ( "Estudiante" );
		$vulnerado->setInstruccion ( "Secundaria" );
		$vulnerado->setCapacidadEspecial ( false );
		$vulnerado->setLegalidad ( "Refugiado" );
		$vulnerado->setTelefono ( "0999999999" );
		$vulnerado->setEmail ( "eeasd2@gmail.com" );
		
		$em = $this->getDoctrine ()->getManager ();
		
		$centrosEducativos = $em->getRepository ( 'AppBundle:CentroEducativo' )->findAll ();
		
		if (! empty ( $centrosEducativos )) {
			$centroEducativo = $centrosEducativos [array_rand ( $centrosEducativos )];
		} else {
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
		}
		
		$vulnerado->setCentroEducativo ( $centroEducativo );
		
		$vulneradoDireccion->setVulnerado ( $vulnerado );
		
		return $vulneradoDireccion;
	}
}
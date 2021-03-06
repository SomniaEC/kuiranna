<?php

namespace AppBundle\Controller;

use AppBundle\Utils\ConstantesDeOperaciones;
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
		$entidadesJunta = ['centroEducativo', 'denuncia', 'usuario'];
		if ($request->getSession ()->get ( 'junta' ) != null && in_array($nombreEntidad, $entidadesJunta)) {
			$entidades = $em->getRepository ( 'AppBundle:' . ucfirst ( $nombreEntidad ) )->findByJunta ($request->getSession ()->get ( 'junta' ));
		} else {
			$entidades = $em->getRepository ( 'AppBundle:' . ucfirst ( $nombreEntidad ) )->findAll ();
		}
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
     * @Route("{nombreEntidad}/crear", name="crear_entidad",
     * requirements={"nombreEntidad" : "actor|direccion|derecho|vulnerado|actorDireccion|vulneradoDireccion|archivo|actividadEconomica|plantilla|operacionDenuncia|auditoria|provincia|canton|parroquia|domicilio|usuario|persona"})
     */
    public function crearEntidadAction(Request $request, $nombreEntidad)
    {
        // 1) build the form
        $operacion = ConstantesDeOperaciones::CREAR;
        $className = "AppBundle\Entity\\" . ucfirst($nombreEntidad);
        $entidad = new $className();
        $mensaje = ucfirst($nombreEntidad) . " creada correctamente";
        $form = $this->createForm($this->getCrearType($nombreEntidad), $entidad);
        
        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
            // 4) save the User!
            $em = $this->getDoctrine()->getManager();
            $em->persist($entidad);
            $em->flush();
            
            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user
            return $this->redirectToRoute('listar_entidad', array(
                "nombreEntidad" => $nombreEntidad,
                "mensaje" => $mensaje
            ));
        }
        
        return $this->render($nombreEntidad . '/' . $nombreEntidad . '.html.twig', array(
            'form' => $form->createView(),
            'nombreEntidad' => $nombreEntidad,
            'operacion' => $operacion
        ));
    }

    /**
     * @Route("{nombreEntidad}/modificar", name="modificar_entidad",
     * requirements={"nombreEntidad" : "actor|direccion|derecho|vulnerado|actorDireccion|vulneradoDireccion|archivo|actividadEconomica|plantilla|operacionDenuncia|auditoria|provincia|canton|parroquia|domicilio|usuario|persona"})
     */
    public function modificarEntidadAction(Request $request, $nombreEntidad)
    {
        // 1) build the form
        $idEntidad = $request->query->get('id');
        $operacion = ConstantesDeOperaciones::MODIFICAR;
        $em = $this->getDoctrine()->getManager();
        $entidad = $em->getRepository('AppBundle:' . ucfirst($nombreEntidad))->find($idEntidad);
        $mensaje = ucfirst($nombreEntidad) . " modificada correctamente";
        $form = $this->createForm($this->getModificarType($nombreEntidad), $entidad);
        
        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
            // 4) save the User!
            $em = $this->getDoctrine()->getManager();
            $em->persist($entidad);
            $em->flush();
            
            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user
            return $this->redirectToRoute('listar_entidad', array(
                "nombreEntidad" => $nombreEntidad,
                "mensaje" => $mensaje
            ));
        }
        
        return $this->render($nombreEntidad . '/' . $nombreEntidad . '.html.twig', array (
	        'form' => $form->createView (),
	        'nombreEntidad' => $nombreEntidad,
	        'operacion' => $operacion
	    ) );
	}
	
	public function getCrearType($nombreEntidad){
		return 'AppBundle\Form\\' . ucfirst ( $nombreEntidad ) . 'Type';
	}
	
	public function getModificarType($nombreEntidad){
		return $this->getCrearType($nombreEntidad);
	}
	
	public function getCrearTodoType($nombreEntidad){
		return 'AppBundle\Form\\' . ucfirst ( $nombreEntidad ) . 'TodoType';
	}
	
	public function getModificarTodoType($nombreEntidad){
		return $this->getCrearType($nombreEntidad);
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
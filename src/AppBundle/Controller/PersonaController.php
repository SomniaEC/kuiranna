<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Persona;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Form\PersonaType;

class PersonaController extends Controller {
	/**
	 * @Route("/persona/prueba")
	 */
	public function createAction() {
		$persona = new Persona ();
		$persona->setCedula("1713848172");
		$persona->setEmail("cesarivanleon@gmail.com");
		$persona->setFechaNacimiento(new \DateTime("21-11-1990"));//dd-mm-aaaa
		$persona->setNacionalidad("Ecuatoriano");
		$persona->setTelefono("0998746548");
		$persona->setNombres("César León");
		
		$em = $this->getDoctrine ()->getManager ();
		
		// tells Doctrine you want to (eventually) save the Product (no queries yet)
		$em->persist ( $persona );
		
		// actually executes the queries (i.e. the INSERT query)
		$em->flush ();

		
		
		return new Response ( 'Saved new persona with id ' . $persona->getId () );
	}
	
	/**
	 * @Route("/persona/crear", name="crear_persona")
	 */
	public function crearPersonaAction(Request $request)
	{
		// 1) build the form
		$persona = new Persona();
		$form = $this->createForm(PersonaType::class, $persona);
	
		// 2) handle the submit (will only happen on POST)
		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {
	
			// 4) save the User!
			$em = $this->getDoctrine()->getManager();
			$em->persist($persona);
			$em->flush();
	
			// ... do any other work - like sending them an email, etc
			// maybe set a "flash" success message for the user
	
			return $this->redirectToRoute('homepage');
		}
	
		return $this->render(
				'persona/persona.html.twig',
				array('form' => $form->createView())
				);
	}
	
	/**
	 * @Route("/persona/listar", name="listar_persona")
	 */
	public function listarPersonaAction(Request $request)
	{
		$em = $this->getDoctrine()->getManager();
		
		$personas = $em->getRepository('AppBundle:Persona')->findAll();
		return $this->render(
				'entidadBase/listarEntidad.html.twig',
				array('entidades' => $personas)
				);
	}
	
	/**
	 * @Route("/persona/modificar", name="modificar_persona")
	 */
	public function modificarPersonaAction(Request $request)
	{
		$idPersona = $request->query->get('id');
		
		$em = $this->getDoctrine()->getManager();
	
		$persona = $em->getRepository('AppBundle:Persona')->find($idPersona);
		
		$form = $this->createForm(PersonaType::class, $persona);
		
		return $this->render(
				'persona/persona.html.twig',
				array('form' => $form->createView())
				);
	}
	
}
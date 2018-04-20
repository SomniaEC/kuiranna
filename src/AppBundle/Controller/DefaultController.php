<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
    	$rol = $request->getSession ()->get('user_rol');
    	if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY') || $rol == null) {
    		return $this->render('default/index.html.twig', [
    				'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
    		]);
    	} else {
    		$em = $this->getDoctrine ()->getManager ();
    		$em->getRepository ( 'AppBundle:Denuncia' )->findAll();
    		
    		
    		return $this->render('default/index.html.twig', [
    				'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
    		]);
    	}
        
    }
}

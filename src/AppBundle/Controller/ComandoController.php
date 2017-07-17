<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\HttpFoundation\Response;

class ComandoController extends Controller {
	/**
	 * @Route("/comando/actualizarbd", name="comando_actualizarbd")
	 */
	public function actualizarbdAction() {
		$kernel = $this->get('kernel');
		$application = new Application($kernel);
 		$application->setAutoExit(false);
 		$input = new ArrayInput(array(
			'command' => 'doctrine:schema:update',
			'--force' => true
		));
 		
		// You can use NullOutput() if you don't need the output 
		$output = new BufferedOutput();
		$application->run($input, $output); 
		
		// return the output, don't use if you used NullOutput() 
		$content = $output->fetch(); 
		
		return $this->render ('comando.html.twig', array (
				'output' => $content
		) );
	}
	
	/**
	 * @Route("/comando/validarbd", name="comando_validarbd")
	 */
	public function validarbdAction() {
		$kernel = $this->get('kernel');
		$application = new Application($kernel);
 		$application->setAutoExit(false);
 		$input = new ArrayInput(array(
			'command' => 'doctrine:schema:validate'
		));
 		
		// You can use NullOutput() if you don't need the output 
		$output = new BufferedOutput();
		$application->run($input, $output); 
		
		// return the output, don't use if you used NullOutput() 
		$content = $output->fetch(); 
		
		// return new Response(""), if you used NullOutput() 
		return $this->render ('comando.html.twig', array (
				'output' => $content
		) );
	}
}
?>
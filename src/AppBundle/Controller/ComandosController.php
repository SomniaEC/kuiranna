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
	 * @Route("/comando/sincronizarbd", name="comando_sincronizarbd")
	 */
	public function sincronizarbdAction() {
		$kernel = $this->get('kernel');
		$application = new Application($kernel);
 		$application->setAutoExit(false);
 		$input = new ArrayInput(array(
			'command' => 'doctrine:schema:update', 
			'--force' => '',
		));
 		
		// You can use NullOutput() if you don't need the output 
		$output = new BufferedOutput();
		$application->run($input, $output); 
		
		// return the output, don't use if you used NullOutput() 
		$content = $output->fetch(); 
		
		// return new Response(""), if you used NullOutput() 
		return new Response($content);
	}
}
?>
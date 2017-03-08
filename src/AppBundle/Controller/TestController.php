<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class TestController {
	/**
	 * @Route("/test")
	 */
	public function numberAction() {
		$number = mt_rand ( 0, 100 );
		
		return new Response ( '<html><body>This is a test web page<br><a href="/">home</a></body></html>' );
	}
}
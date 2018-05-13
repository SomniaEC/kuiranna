<?php

namespace AppBundle\Utils\Extensions;

use AppBundle\Utils\Constantes;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\DateTime;

class AppExtensions extends \Twig_Extension {
	public function getFilters() {
		return array (
				new \Twig_SimpleFilter ( 'expira', array (
						$this,
						'expiraFilter' 
				) ) 
		);
	}
	public function expiraFilter($date) {
		$date = new \DateTime($date->format('Y-m-d'));
		$date = $date->add(new \DateInterval(Constantes::DIAS_EXPIRA));
		$today = new \DateTime();
		$today = new \DateTime($today->format('Y-m-d'));
		$difference = $today->diff($date);
		$days = $difference->format('%r%d') + $difference->h / 24;
		if($days <= 0) {
			$days_string = "0 días";
		} else {
			$days_string = $days . " días";
		}
		return $days_string;
	}
} 
<?php

namespace AppBundle\Utils\Extensions;

use AppBundle\Utils\Constantes;

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
		$date = $date->add(new \DateInterval(Constantes::DIAS_EXPIRA));
		$today = new \DateTime();
		$difference = $today->diff($date);
		$days = $difference->format('%r%d') + $difference->h / 24;
		if($days <= 0) {
			$days_string = "0 días";
		} else {
			$days_string = round($days, 0) . " días";
		}
		return $days_string;
	}
} 
<?php

namespace AppBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;

class Builder {
	private $factory;
	
	/**
	 *
	 * @param FactoryInterface $factory
	 *        	Add any other dependency you need
	 */
	public function __construct(FactoryInterface $factory) {
		$this->factory = $factory;
	}
	public function createMainMenu(array $options) {
		$menu = $this->factory->createItem ( 'root' );
		$menu->setChildrenAttributes(array('class' => 'topnav'));
		$menu->addChild ( 'Home', array (
				'route' => 'homepage' 
		) );
		
		$menu->addChild ( 'Actor', array (
				'uri' => '#' 
		) );
		$menu ['Actor']->setAttribute('class', 'dropdown');
		$menu ['Actor']->addChild ( 'Listar Actores', array (
				'route' => 'listar_entidad',
				'routeParameters' => array (
						"nombreEntidad" => "actor" 
				)
		) );
		$menu ['Actor']->addChild ( 'Crear Actores', array (
				'route' => 'guardar_entidad',
				'routeParameters' => array (
						"nombreEntidad" => "actor"
				)
		) );
		
		$menu->addChild ( 'Direccion', array (
				'uri' => '#'
		) );
		$menu ['Direccion']->setAttribute('class', 'dropdown');
		$menu ['Direccion']->addChild ( 'Listar Direccions', array (
				'route' => 'listar_entidad',
				'routeParameters' => array (
						"nombreEntidad" => "direccion"
				)
		) );
		$menu ['Direccion']->addChild ( 'Crear Direccions', array (
				'route' => 'guardar_entidad',
				'routeParameters' => array (
						"nombreEntidad" => "direccion"
				)
		) );
		
		$menu->addChild ( 'CentroEducativo', array (
				'uri' => '#'
		) );
		$menu ['CentroEducativo']->setAttribute('class', 'dropdown');
		$menu ['CentroEducativo']->addChild ( 'Listar CentroEducativos', array (
				'route' => 'listar_entidad',
				'routeParameters' => array (
						"nombreEntidad" => "centroEducativo"
				)
		) );
		$menu ['CentroEducativo']->addChild ( 'Crear CentroEducativos', array (
				'route' => 'guardar_entidad',
				'routeParameters' => array (
						"nombreEntidad" => "centroEducativo"
				)
		) );
		
		$menu->addChild ( 'Derecho', array (
				'uri' => '#'
		) );
		$menu ['Derecho']->setAttribute('class', 'dropdown');
		$menu ['Derecho']->addChild ( 'Listar Derechos', array (
				'route' => 'listar_entidad',
				'routeParameters' => array (
						"nombreEntidad" => "derecho"
				)
		) );
		$menu ['Derecho']->addChild ( 'Crear Derecho', array (
				'route' => 'guardar_entidad',
				'routeParameters' => array (
						"nombreEntidad" => "derecho"
				)
		) );
		
		$menu->addChild ( 'Vulnerado', array (
				'uri' => '#'
		) );
		$menu ['Vulnerado']->setAttribute('class', 'dropdown');
		$menu ['Vulnerado']->addChild ( 'Listar Vulnerados', array (
				'route' => 'listar_entidad',
				'routeParameters' => array (
						"nombreEntidad" => "vulnerado"
				)
		) );
		$menu ['Vulnerado']->addChild ( 'Crear Vulnerados', array (
				'route' => 'guardar_entidad',
				'routeParameters' => array (
						"nombreEntidad" => "vulnerado"
				)
		) );
		
		$menu->addChild ( 'Junta', array (
				'uri' => '#'
		) );
		$menu ['Junta']->setAttribute('class', 'dropdown');
		$menu ['Junta']->addChild ( 'Listar Juntas', array (
				'route' => 'listar_entidad',
				'routeParameters' => array (
						"nombreEntidad" => "junta"
				)
		) );
		$menu ['Junta']->addChild ( 'Crear Juntas', array (
				'route' => 'guardar_entidad',
				'routeParameters' => array (
						"nombreEntidad" => "junta"
				)
		) );
		return $menu;
	}
}
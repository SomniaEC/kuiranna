<?php

namespace AppBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;

class MenuBuilder {
	private $factory;
	private $authorizationChecker;
	public function __construct(FactoryInterface $factory, AuthorizationChecker $authorizationChecker) {
		$this->factory = $factory;
		$this->authorizationChecker = $authorizationChecker;
	}
	public function createMainMenu(array $options) {
		$menu = $this->factory->createItem ( 'root' );
		$menu->setChildrenAttributes ( array (
				'class' => 'topnav'
		) );
		$auth_checker = $this->authorizationChecker->isGranted ( 'IS_AUTHENTICATED_REMEMBERED' );
		
		if (! $auth_checker) {
			$menu->addChild ( 'Login', array (
					'route' => 'fos_user_security_login' 
			) );
		} else {
			$menu->addChild ( 'Home', array (
					'route' => 'homepage' 
			) );
			
			$menu->addChild ( 'Persona', array (
					'uri' => '#' 
			) );
			$menu ['Persona']->setAttribute ( 'class', 'dropdown' );
			$menu ['Persona']->addChild ( 'Listar Personas', array (
					'route' => 'listar_entidad',
					'routeParameters' => array (
							"nombreEntidad" => "persona" 
					) 
			) );
			$menu ['Persona']->addChild ( 'Crear Personas', array (
					'route' => 'guardar_entidad',
					'routeParameters' => array (
							"nombreEntidad" => "persona" 
					) 
			) );
			
			$menu->addChild ( 'Domicilio', array (
					'uri' => '#' 
			) );
			$menu ['Domicilio']->setAttribute ( 'class', 'dropdown' );
			$menu ['Domicilio']->addChild ( 'Listar Domicilios', array (
					'route' => 'listar_entidad',
					'routeParameters' => array (
							"nombreEntidad" => "domicilio" 
					) 
			) );
			$menu ['Domicilio']->addChild ( 'Crear Domicilios', array (
					'route' => 'guardar_entidad',
					'routeParameters' => array (
							"nombreEntidad" => "domicilio" 
					) 
			) );
			
			$menu->addChild ( 'CentroEducativo', array (
					'uri' => '#' 
			) );
			$menu ['CentroEducativo']->setAttribute ( 'class', 'dropdown' );
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
			$menu ['Derecho']->setAttribute ( 'class', 'dropdown' );
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
			$menu ['Vulnerado']->setAttribute ( 'class', 'dropdown' );
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
			$menu ['Junta']->setAttribute ( 'class', 'dropdown' );
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
			$menu->addChild ( 'Logout', array (
					'route' => 'fos_user_security_logout'
			) );
		}
		return $menu;
	}
	public function createLoginMenu($menu) {
		return $menu;
	}
	public function createLoggedMenu($menu) {
		return $menu;
	}
}
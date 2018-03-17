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
	
	public function createSuperAdminMenu(array $options) {
		$menu = $this->factory->createItem ( 'root' );
		$menu->setChildrenAttributes ( array (
				'class' => 'topnav'
		) );
	
		$menu->addChild ( 'Home', array (
				'route' => 'homepage'
		) );
		
		$menu->addChild ( 'Usuario', array (
				'uri' => '#'
		) );
		$menu ['Usuario']->setAttribute ( 'class', 'dropdown' );
		$menu ['Usuario']->addChild ( 'Registrar Usuario', array (
				'route' => 'fos_user_registration_register'
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
	
// 		$menu->addChild ( 'Domicilio', array (
// 				'uri' => '#'
// 		) );
// 		$menu ['Domicilio']->setAttribute ( 'class', 'dropdown' );
// 		$menu ['Domicilio']->addChild ( 'Listar Domicilios', array (
// 				'route' => 'listar_entidad',
// 				'routeParameters' => array (
// 						"nombreEntidad" => "domicilio"
// 				)
// 		) );
// 		$menu ['Domicilio']->addChild ( 'Crear Domicilios', array (
// 				'route' => 'guardar_entidad',
// 				'routeParameters' => array (
// 						"nombreEntidad" => "domicilio"
// 				)
// 		) );
	
// 		$menu->addChild ( 'CentroEducativo', array (
// 				'uri' => '#'
// 		) );
// 		$menu ['CentroEducativo']->setAttribute ( 'class', 'dropdown' );
// 		$menu ['CentroEducativo']->addChild ( 'Listar CentroEducativos', array (
// 				'route' => 'listar_entidad',
// 				'routeParameters' => array (
// 						"nombreEntidad" => "centroEducativo"
// 				)
// 		) );
// 		$menu ['CentroEducativo']->addChild ( 'Crear CentroEducativos', array (
// 				'route' => 'guardar_entidad',
// 				'routeParameters' => array (
// 						"nombreEntidad" => "centroEducativo"
// 				)
// 		) );
	
// 		$menu->addChild ( 'Derecho', array (
// 				'uri' => '#'
// 		) );
// 		$menu ['Derecho']->setAttribute ( 'class', 'dropdown' );
// 		$menu ['Derecho']->addChild ( 'Listar Derechos', array (
// 				'route' => 'listar_entidad',
// 				'routeParameters' => array (
// 						"nombreEntidad" => "derecho"
// 				)
// 		) );
// 		$menu ['Derecho']->addChild ( 'Crear Derecho', array (
// 				'route' => 'guardar_entidad',
// 				'routeParameters' => array (
// 						"nombreEntidad" => "derecho"
// 				)
// 		) );
	
// 		$menu->addChild ( 'Vulnerado', array (
// 				'uri' => '#'
// 		) );
// 		$menu ['Vulnerado']->setAttribute ( 'class', 'dropdown' );
// 		$menu ['Vulnerado']->addChild ( 'Listar Vulnerados', array (
// 				'route' => 'listar_entidad',
// 				'routeParameters' => array (
// 						"nombreEntidad" => "vulnerado"
// 				)
// 		) );
// 		$menu ['Vulnerado']->addChild ( 'Crear Vulnerados', array (
// 				'route' => 'guardar_entidad',
// 				'routeParameters' => array (
// 						"nombreEntidad" => "vulnerado"
// 				)
// 		) );
	
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
	
		return $menu;
	}
	
	public function createAdminDeJuntaMenu(array $options) {
		$menu = $this->factory->createItem ( 'root' );
		$menu->setChildrenAttributes ( array (
				'class' => 'topnav' 
		) );
		
		$menu->addChild ( 'Home', array (
				'route' => 'homepage' 
		) );
		
		$menu->addChild ( 'Usuario', array (
				'uri' => '#'
		) );
		$menu ['Usuario']->setAttribute ( 'class', 'dropdown' );
		$menu ['Usuario']->addChild ( 'Registrar Usuario', array (
				'route' => 'fos_user_registration_register'
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
		
		return $menu;
	}
	
	public function createLoginMenu($menu) {
		$menu = $this->factory->createItem ( 'root' );
		$menu->setChildrenAttributes ( array (
				'class' => 'topnav' 
		) );
		
		$menu->addChild ( 'Login', array (
				'route' => 'fos_user_security_login' 
		) );
		return $menu;
	}
	public function createSecretarioMenu($menu) {

		$menu = $this->factory->createItem ( 'root' );
		$menu->setChildrenAttributes ( array (
				'class' => 'topnav'
		) );
		
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
		
// 		$menu->addChild ( 'CentroEducativo', array (
// 				'uri' => '#'
// 		) );
// 		$menu ['CentroEducativo']->setAttribute ( 'class', 'dropdown' );
// 		$menu ['CentroEducativo']->addChild ( 'Listar CentroEducativos', array (
// 				'route' => 'listar_entidad',
// 				'routeParameters' => array (
// 						"nombreEntidad" => "centroEducativo"
// 				)
// 		) );
		
// 		$menu->addChild ( 'Derecho', array (
// 				'uri' => '#'
// 		) );
// 		$menu ['Derecho']->setAttribute ( 'class', 'dropdown' );
// 		$menu ['Derecho']->addChild ( 'Listar Derechos', array (
// 				'route' => 'listar_entidad',
// 				'routeParameters' => array (
// 						"nombreEntidad" => "derecho"
// 				)
// 		) );
		
// 		$menu->addChild ( 'Vulnerado', array (
// 				'uri' => '#'
// 		) );
// 		$menu ['Vulnerado']->setAttribute ( 'class', 'dropdown' );
// 		$menu ['Vulnerado']->addChild ( 'Listar Vulnerados', array (
// 				'route' => 'listar_entidad',
// 				'routeParameters' => array (
// 						"nombreEntidad" => "vulnerado"
// 				)
// 		) );
// 		$menu->addChild ( 'Junta', array (
// 				'uri' => '#'
// 		) );
// 		$menu ['Junta']->setAttribute ( 'class', 'dropdown' );
// 		$menu ['Junta']->addChild ( 'Listar Juntas', array (
// 				'route' => 'listar_entidad',
// 				'routeParameters' => array (
// 						"nombreEntidad" => "junta"
// 				)
// 		) );
// 		$menu->addChild ( 'Logout', array (
// 				'route' => 'fos_user_security_logout'
// 		) );
		
		return $menu;
	}
	
	public function createMiembroDeJuntaMenu($menu) {
	
		$menu = $this->factory->createItem ( 'root' );
		$menu->setChildrenAttributes ( array (
				'class' => 'topnav'
		) );
	
		$menu->addChild ( 'Home', array (
				'route' => 'homepage'
		) );
	
		$menu->addChild ( 'Persona', array (
				'uri' => '#'
		) );
// 		$menu ['Persona']->setAttribute ( 'class', 'dropdown' );
// 		$menu ['Persona']->addChild ( 'Listar Personas', array (
// 				'route' => 'listar_entidad',
// 				'routeParameters' => array (
// 						"nombreEntidad" => "persona"
// 				)
// 		) );
	
// 		$menu->addChild ( 'Domicilio', array (
// 				'uri' => '#'
// 		) );
// 		$menu ['Domicilio']->setAttribute ( 'class', 'dropdown' );
// 		$menu ['Domicilio']->addChild ( 'Listar Domicilios', array (
// 				'route' => 'listar_entidad',
// 				'routeParameters' => array (
// 						"nombreEntidad" => "domicilio"
// 				)
// 		) );
// 		$menu ['Domicilio']->addChild ( 'Crear Domicilios', array (
// 				'route' => 'guardar_entidad',
// 				'routeParameters' => array (
// 						"nombreEntidad" => "domicilio"
// 				)
// 		) );
	
// 		$menu->addChild ( 'CentroEducativo', array (
// 				'uri' => '#'
// 		) );
// 		$menu ['CentroEducativo']->setAttribute ( 'class', 'dropdown' );
// 		$menu ['CentroEducativo']->addChild ( 'Listar CentroEducativos', array (
// 				'route' => 'listar_entidad',
// 				'routeParameters' => array (
// 						"nombreEntidad" => "centroEducativo"
// 				)
// 		) );
	
// 		$menu->addChild ( 'Derecho', array (
// 				'uri' => '#'
// 		) );
// 		$menu ['Derecho']->setAttribute ( 'class', 'dropdown' );
// 		$menu ['Derecho']->addChild ( 'Listar Derechos', array (
// 				'route' => 'listar_entidad',
// 				'routeParameters' => array (
// 						"nombreEntidad" => "derecho"
// 				)
// 		) );
	
// 		$menu->addChild ( 'Vulnerado', array (
// 				'uri' => '#'
// 		) );
// 		$menu ['Vulnerado']->setAttribute ( 'class', 'dropdown' );
// 		$menu ['Vulnerado']->addChild ( 'Listar Vulnerados', array (
// 				'route' => 'listar_entidad',
// 				'routeParameters' => array (
// 						"nombreEntidad" => "vulnerado"
// 				)
// 		) );
// 		$menu->addChild ( 'Junta', array (
// 				'uri' => '#'
// 		) );
// 		$menu ['Junta']->setAttribute ( 'class', 'dropdown' );
// 		$menu ['Junta']->addChild ( 'Listar Juntas', array (
// 				'route' => 'listar_entidad',
// 				'routeParameters' => array (
// 						"nombreEntidad" => "junta"
// 				)
// 		) );
// 		$menu->addChild ( 'Logout', array (
// 				'route' => 'fos_user_security_logout'
// 		) );
	
		return $menu;
	}
	
	public function createPsicologoMenu($menu) {
	
		$menu = $this->factory->createItem ( 'root' );
		$menu->setChildrenAttributes ( array (
				'class' => 'topnav'
		) );
	
// 		$menu->addChild ( 'Home', array (
// 				'route' => 'homepage'
// 		) );
	
// 		$menu->addChild ( 'Persona', array (
// 				'uri' => '#'
// 		) );
// 		$menu ['Persona']->setAttribute ( 'class', 'dropdown' );
// 		$menu ['Persona']->addChild ( 'Listar Personas', array (
// 				'route' => 'listar_entidad',
// 				'routeParameters' => array (
// 						"nombreEntidad" => "persona"
// 				)
// 		) );
	
// 		$menu->addChild ( 'Domicilio', array (
// 				'uri' => '#'
// 		) );
// 		$menu ['Domicilio']->setAttribute ( 'class', 'dropdown' );
// 		$menu ['Domicilio']->addChild ( 'Listar Domicilios', array (
// 				'route' => 'listar_entidad',
// 				'routeParameters' => array (
// 						"nombreEntidad" => "domicilio"
// 				)
// 		) );
// 		$menu ['Domicilio']->addChild ( 'Crear Domicilios', array (
// 				'route' => 'guardar_entidad',
// 				'routeParameters' => array (
// 						"nombreEntidad" => "domicilio"
// 				)
// 		) );
	
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
		$menu->addChild ( 'Logout', array (
				'route' => 'fos_user_security_logout'
		) );
	
		return $menu;
	}
}
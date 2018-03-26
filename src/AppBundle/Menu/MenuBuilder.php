<?php
namespace AppBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;

class MenuBuilder
{

    private $factory;

    private $authorizationChecker;

    public function __construct(FactoryInterface $factory, AuthorizationChecker $authorizationChecker)
    {
        $this->factory = $factory;
        $this->authorizationChecker = $authorizationChecker;
    }

    public function createSuperAdminMenu(array $options)
    {
        $menu = $this->factory->createItem('root');
        $menu->setChildrenAttributes(array(
            'class' => 'topnav'
        ));
        
        // Inicio menu
        $menu->addChild('Inicio', array(
            'route' => 'homepage'
        ));
        
        // Catalogo menu
        $menu->addChild('Catálogos', array(
            'uri' => '#'
        ));
        $menu['Catálogos']->setAttribute('class', 'dropdown');
        $menu['Catálogos']->addChild('Centros Educativos', array(
            'route' => 'listar_entidad',
            'routeParameters' => array(
                'nombreEntidad' => 'centroEducativo'
            )
        ));
        $menu['Catálogos']->addChild('Derechos Vulnerados', array(
            'route' => 'listar_entidad',
            'routeParameters' => array(
                'nombreEntidad' => 'derecho'
            )
        ));
        
        // Denuncia menu
        $menu->addChild('Denuncia', array(
            'uri' => '#'
        ));
        $menu['Denuncia']->setAttribute('class', 'dropdown');
        $menu['Denuncia']->addChild('Crear', array(
            'route' => 'guardar_denuncia'
        ));
        $menu['Denuncia']->addChild('Gestionar', array(
            'route' => 'listar_entidad',
            'routeParameters' => array(
                'nombreEntidad' => 'denuncia'
            )
        ));
        $menu['Denuncia']->addChild('Búsqueda avanzada', array(
            'uri' => '#'
        ));
        
        // Auditoría menu
        $menu->addChild('Auditoría', array(
            'uri' => '#'
        ));
        $menu['Auditoría']->setAttribute('class', 'dropdown');
        $menu['Auditoría']->addChild('Consultar', array(
            'uri' => '#'
        ));
        
        // Denuncia menu
        $menu->addChild('Administración', array(
            'uri' => '#'
        ));
        
        // Administracion menu
        $menu['Administración']->setAttribute('class', 'dropdown');
        $menu['Administración']->addChild('Junta', array(
            'route' => 'listar_entidad',
            'routeParameters' => array(
                'nombreEntidad' => 'junta'
            )
        ));
        
        // Localidad Menu
        $menuLocalidad = $menu['Administración']->addChild('Localidad', array(
            'uri' => '#',
            'class' => 'dropdown'
        ));
        $menuLocalidad->addChild('Provincia', array(
            'route' => 'listar_entidad',
            'routeParameters' => array(
                'nombreEntidad' => 'provincia'
            )
        ));
        $menuLocalidad->addChild('Cantón', array(
            'route' => 'listar_entidad',
            'routeParameters' => array(
                'nombreEntidad' => 'canton'
            )
        ));
        $menuLocalidad->addChild('Parroquia', array(
            'route' => 'listar_entidad',
            'routeParameters' => array(
                'nombreEntidad' => 'parroquia'
            )
        ));
        // Seguridad menu
        $menu->addChild('Seguridad', array(
            'uri' => '#'
        ));
        $menu['Seguridad']->setAttribute('class', 'dropdown');
        $menu['Seguridad']->addChild('Usuarios', array(
            'route' => 'listar_entidad',
            'routeParameters' => array(
                'nombreEntidad' => 'usuario'
            )
        ));
        
        // Herramientas menu
        $menu->addChild('Herramientas', array(
            'uri' => '#'
        ));
        $menu['Herramientas']->setAttribute('class', 'dropdown');
        $menu['Herramientas']->addChild('Actualizar BD', array(
            'route' => 'comando_actualizarbd'
        ));
        $menu['Herramientas']->addChild('Validar BD', array(
            'route' => 'comando_validarbd'
        ));
        
        // Ayuda menu
        $menu->addChild('Ayuda', array(
            'uri' => '#'
        ));
        $menu['Ayuda']->setAttribute('class', 'dropdown');
        $menu['Ayuda']->addChild('Temas de ayuda', array(
            'uri' => '#'
        ));
        $menu['Ayuda']->addChild('Sugerencias', array(
            'uri' => '#'
        ));
        $menu['Ayuda']->addChild('Acerca de', array(
            'uri' => '#'
        ));
        
        // Logout
        $menu->addChild('Logout', array(
            'route' => 'fos_user_security_logout'
        ));
        
        return $menu;
    }

    public function createAdminDeJuntaMenu(array $options)
    {
        $menu = $this->factory->createItem('root');
        $menu->setChildrenAttributes(array(
            'class' => 'topnav'
        ));
        
        // Inicio menu
        $menu->addChild('Inicio', array(
            'route' => 'homepage'
        ));
        
        // Catalogo menu
        $menu->addChild('Catálogos', array(
            'uri' => '#'
        ));
        $menu['Catálogos']->setAttribute('class', 'dropdown');
        $menu['Catálogos']->addChild('Centros Educativos', array(
            'route' => 'listar_entidad',
            'routeParameters' => array(
                'nombreEntidad' => 'centroEducativo'
            )
        ));
        $menu['Catálogos']->addChild('Derechos Vulnerados', array(
            'route' => 'listar_entidad',
            'routeParameters' => array(
                'nombreEntidad' => 'derecho'
            )
        ));
        
        // Denuncia menu
        $menu->addChild('Denuncia', array(
            'uri' => '#'
        ));
        $menu['Denuncia']->setAttribute('class', 'dropdown');
        $menu['Denuncia']->addChild('Crear', array(
            'route' => 'guardar_denuncia'
        ));
        $menu['Denuncia']->addChild('Gestionar', array(
            'route' => 'listar_entidad',
            'routeParameters' => array(
                'nombreEntidad' => 'denuncia'
            )
        ));
        $menu['Denuncia']->addChild('Búsqueda avanzada', array(
            'uri' => '#'
        ));
        
        // Auditoría menu
        $menu->addChild('Auditoría', array(
            'uri' => '#'
        ));
        $menu['Auditoría']->setAttribute('class', 'dropdown');
        $menu['Auditoría']->addChild('Consultar', array(
            'uri' => '#'
        ));
        
        // Denuncia menu
        $menu->addChild('Administración', array(
            'uri' => '#'
        ));
        
        // Administracion menu
        $menu['Administración']->setAttribute('class', 'dropdown');
        $menu['Administración']->addChild('Junta', array(
            'route' => 'listar_entidad',
            'routeParameters' => array(
                'nombreEntidad' => 'junta'
            )
        ));
        
        // Localidad Menu
        $menuLocalidad = $menu['Administración']->addChild('Localidad', array(
            'uri' => '#',
            'class' => 'dropdown'
        ));
        $menuLocalidad->addChild('Provincia', array(
            'route' => 'listar_entidad',
            'routeParameters' => array(
                'nombreEntidad' => 'provincia'
            )
        ));
        $menuLocalidad->addChild('Cantón', array(
            'route' => 'listar_entidad',
            'routeParameters' => array(
                'nombreEntidad' => 'canton'
            )
        ));
        $menuLocalidad->addChild('Parroquia', array(
            'route' => 'listar_entidad',
            'routeParameters' => array(
                'nombreEntidad' => 'parroquia'
            )
        ));
        // Seguridad menu
        $menu->addChild('Seguridad', array(
            'uri' => '#'
        ));
        $menu['Seguridad']->setAttribute('class', 'dropdown');
        $menu['Seguridad']->addChild('Usuarios', array(
            'route' => 'listar_entidad',
            'routeParameters' => array(
                'nombreEntidad' => 'usuario'
            )
        ));
        
        // Ayuda menu
        $menu->addChild('Ayuda', array(
            'uri' => '#'
        ));
        $menu['Ayuda']->setAttribute('class', 'dropdown');
        $menu['Ayuda']->addChild('Temas de ayuda', array(
            'uri' => '#'
        ));
        $menu['Ayuda']->addChild('Sugerencias', array(
            'uri' => '#'
        ));
        $menu['Ayuda']->addChild('Acerca de', array(
            'uri' => '#'
        ));
        
        // Logout
        $menu->addChild('Logout', array(
            'route' => 'fos_user_security_logout'
        ));
        
        return $menu;
    }

    public function createLoginMenu($menu)
    {
        $menu = $this->factory->createItem('root');
        $menu->setChildrenAttributes(array(
            'class' => 'topnav'
        ));
        
        $menu->addChild('Login', array(
            'route' => 'fos_user_security_login'
        ));
        return $menu;
    }

    public function createSecretarioMenu($menu)
    {
        $menu = $this->factory->createItem('root');
        $menu->setChildrenAttributes(array(
            'class' => 'topnav'
        ));
        
        // Inicio menu
        $menu->addChild('Inicio', array(
            'route' => 'homepage'
        ));
        
        // Catalogo menu
        $menu->addChild('Catálogos', array(
            'uri' => '#'
        ));
        $menu['Catálogos']->setAttribute('class', 'dropdown');
        $menu['Catálogos']->addChild('Centros Educativos', array(
            'route' => 'listar_entidad',
            'routeParameters' => array(
                'nombreEntidad' => 'centroEducativo'
            )
        ));
        $menu['Catálogos']->addChild('Derechos Vulnerados', array(
            'route' => 'listar_entidad',
            'routeParameters' => array(
                'nombreEntidad' => 'derecho'
            )
        ));
        
        // Denuncia menu
        $menu->addChild('Denuncia', array(
            'uri' => '#'
        ));
        $menu['Denuncia']->setAttribute('class', 'dropdown');
        $menu['Denuncia']->addChild('Crear', array(
            'route' => 'guardar_denuncia'
        ));
        $menu['Denuncia']->addChild('Gestionar', array(
            'route' => 'listar_entidad',
            'routeParameters' => array(
                'nombreEntidad' => 'denuncia'
            )
        ));
        $menu['Denuncia']->addChild('Búsqueda avanzada', array(
            'uri' => '#'
        ));
        
        // Denuncia menu
        $menu->addChild('Administración', array(
            'uri' => '#'
        ));
        
        // Administracion menu
        $menu['Administración']->setAttribute('class', 'dropdown');
        $menu['Administración']->addChild('Junta', array(
            'route' => 'listar_entidad',
            'routeParameters' => array(
                'nombreEntidad' => 'junta'
            )
        ));
        
        // Localidad Menu
        $menuLocalidad = $menu['Administración']->addChild('Localidad', array(
            'uri' => '#',
            'class' => 'dropdown'
        ));
        $menuLocalidad->addChild('Provincia', array(
            'route' => 'listar_entidad',
            'routeParameters' => array(
                'nombreEntidad' => 'provincia'
            )
        ));
        $menuLocalidad->addChild('Cantón', array(
            'route' => 'listar_entidad',
            'routeParameters' => array(
                'nombreEntidad' => 'canton'
            )
        ));
        $menuLocalidad->addChild('Parroquia', array(
            'route' => 'listar_entidad',
            'routeParameters' => array(
                'nombreEntidad' => 'parroquia'
            )
        ));
        
        // Ayuda menu
        $menu->addChild('Ayuda', array(
            'uri' => '#'
        ));
        $menu['Ayuda']->setAttribute('class', 'dropdown');
        $menu['Ayuda']->addChild('Temas de ayuda', array(
            'uri' => '#'
        ));
        $menu['Ayuda']->addChild('Sugerencias', array(
            'uri' => '#'
        ));
        $menu['Ayuda']->addChild('Acerca de', array(
            'uri' => '#'
        ));
        
        // Logout
        $menu->addChild('Logout', array(
            'route' => 'fos_user_security_logout'
        ));
        
        return $menu;
    }

    public function createMiembroDeJuntaMenu($menu)
    {
        return $this->createSecretarioMenu($menu);
    }

    public function createPsicologoMenu($menu)
    {
        return $this->createSecretarioMenu($menu);
    }
}
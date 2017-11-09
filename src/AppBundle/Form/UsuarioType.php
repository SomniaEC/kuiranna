<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class UsuarioType extends AbstractType {
	/**
	 *
	 * {@inheritdoc}
	 *
	 */
	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder->add ( 'cedula' );
		$builder->add ( 'telefonoConvencional' );
		$builder->add ( 'telefonoCelular' );
		$builder->add ( 'cargo' );
		$builder->add ( 'fechaInicio' );
		$builder->add ( 'fechaFin' );
		$builder->add ( 'estadoActividad' );
		$builder->add ( 'junta' );
		$builder->add('roles', ChoiceType::class, array(
                'label' => 'Rol',
                'required' => true,
                'choices' => $this->getExistingRoles(),
                'multiple' => true));
	}
	public function getParent() {
		return 'FOS\UserBundle\Form\Type\RegistrationFormType';
	}
	public function getBlockPrefix() {
		return 'app_user_registration';
	}
	public function getName() {
		return $this->getBlockPrefix ();
	}
	public function getExistingRoles() {
		
		return array ('ROLE_ADMIN' => 'ROLE_ADMIN', 'ROLE_USER' => 'ROLE_USER', 'ROLE_CUSTOMER' => 'ROLE_CUSTOMER');
		// sintaxis dentro de admin class:
// 		$roleHierarchy = $this->getConfigurationPool()->getContainer()->getParameter('security.role_hierarchy.roles');
		// sintaxis dentro de un controlador:
// 		$container = new ContainerBuilder();
// 		$roleHierarchy = $container->getParameter('security.role_hierarchy.roles');
// 		$roles = array_keys($roleHierarchy);
// 		$theRoles = array();
	
// 		foreach ($roles as $role) {
// 			$theRoles[$role] = $role;
// 		}
// 		return $theRoles;
	}
}

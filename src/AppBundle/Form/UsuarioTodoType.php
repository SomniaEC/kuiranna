<?php

namespace AppBundle\Form;

use FOS\UserBundle\Form\Type\RegistrationFormType as BaseRegistrationFormType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;

class UsuarioTodoType extends AbstractType {
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
		$builder->add ( 'junta' );
		$builder->add ( 'rol', ChoiceType::class, array (
				'label' => 'Rol',
				'required' => true,
				'choices' => $this->getExistingRoles (),
				'multiple' => false,
				'expanded' => false, // render check-boxes
		)
		) ;
		$builder->add('enabled', CheckboxType::class, array(
				'label'    => 'Activo',
				'required' => false
		));
	}
	public function getParent() {
		return BaseRegistrationFormType::class;
	}
	public function getBlockPrefix() {
		return 'app_user_registration';
	}
	public function getName() {
		return $this->getBlockPrefix ();
	}
	public function getExistingRoles() {
		return array (
				'Secretario' => 'ROLE_SECRETARIO',
				'Miembro de junta'=> 'ROLE_MIEMBRO_DE_JUNTA', 
				'Psicólogo'=> 'ROLE_PSICOLOGO', 
				'Administrador de Junta'=> 'ROLE_ADMIN_JUNTA',
				'Super Admin' => 'ROLE_SUPER_ADMIN');
	}
	
}

<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class UsuarioModificarTodoType extends AbstractType {
	/**
	 *
	 * {@inheritdoc}
	 *
	 */
	public function buildForm(FormBuilderInterface $builder, array $options) {
	    $builder->get('plainPassword')->setRequired(false);
	}

	public function getExistingRoles() {
		return array (
				'Secretario' => 'ROLE_SECRETARIO',
				'Miembro de junta' => 'ROLE_MIEMBRO_DE_JUNTA',
				'Psicólogo' => 'ROLE_PSICOLOGO',
				'Administrador de Junta' => 'ROLE_ADMIN_JUNTA',
				'Super Admin' => 'ROLE_SUPER_ADMIN' 
		);
	}
	public function getParent() {
	    return UsuarioTodoType::class;
	}
}

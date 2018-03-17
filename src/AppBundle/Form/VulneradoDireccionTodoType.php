<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VulneradoDireccionTodoType extends AbstractType {
	/**
	 *
	 * {@inheritdoc}
	 *
	 */
	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder->add ( 'vulnerado', VulneradoType::class)
		->add ( 'direccion', DireccionType::class, array (
				'label_attr' => array (
						'class' => 'container_label' 
				),
				'attr' => array (
						'class' => 'container_value' 
				) 
		) );
	}
	
	/**
	 *
	 * {@inheritdoc}
	 *
	 */
	public function configureOptions(OptionsResolver $resolver) {
		$resolver->setDefaults ( array (
				'data_class' => 'AppBundle\Entity\VulneradoDireccion' 
		) );
	}
	
	/**
	 *
	 * {@inheritdoc}
	 *
	 */
	public function getBlockPrefix() {
		return 'vulneradodireccion';
	}
}

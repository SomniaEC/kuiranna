<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CentroEducativoType extends AbstractType {
	
	/**
	 *
	 * {@inheritdoc}
	 */
	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder->add ( 'identificacion', TextType::class, array (
				'required' => false,
				'attr' => array (
						'maxlength' => '13' 
				) 
		) )->add ( 'nombre', TextType::class, array (
				'required' => true,
				'attr' => array (
						'class' => 'uppercase' 
				) 
		) )->add ( 'telefono', TextType::class, array (
				'required' => false,
				'attr' => array (
						'maxlength' => '10' 
				) 
		) )->add ( 'direccion', DireccionType::class, array (
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
	 */
	public function configureOptions(OptionsResolver $resolver) {
		$resolver->setDefaults ( array (
				'data_class' => 'AppBundle\Entity\CentroEducativo' 
		) );
	}
	
	/**
	 *
	 * {@inheritdoc}
	 */
	public function getBlockPrefix() {
		return 'centroeducativo';
	}
}

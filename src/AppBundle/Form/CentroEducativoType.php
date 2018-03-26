<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CentroEducativoType extends AbstractType {
	/**
	 *
	 * {@inheritdoc}
	 */
	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder->add ( 'identificacion' , TextType::class, array (
				'required' => false,
				'attr' => array (
						'maxlength' => '13'
				)
		) )->add ( 'nombre' , TextType::class, array (
				'required' => true,
				'attr' => array('class'=>'uppercase')
		) )->add ( 'telefono' , TextType::class, array (
				'required' => false,
				'attr' => array('class'=>'solo_numeros')
		) )->add ( 'junta' )->add ( 'direccion', DireccionType::class, array (
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

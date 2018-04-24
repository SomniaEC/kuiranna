<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class JuntaType extends AbstractType {
	/**
	 *
	 * {@inheritdoc}
	 *
	 */
	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder->add ( 'nombre' , TextType::class, array (
				'attr' => array('class'=>'uppercase')
		))->add ( 'ruc' , TextType::class, array (
				'required' => false,
				'attr' => array (
						'maxlength' => '13'
				)
		) )->add ( 'telefono' , TextType::class, array (
				'required' => false,
				'attr' => array (
						'maxlength' => '10'
				)
		) )->add ( 'email' , EmailType::class, array (
				'required' => false
		) )->add ( 'logo_img' , FileType::class, array (
				'required' => false,
				'mapped' => false
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
	 *
	 */
	public function configureOptions(OptionsResolver $resolver) {
		$resolver->setDefaults ( array (
				'data_class' => 'AppBundle\Entity\Junta' 
		) );
	}
	
	/**
	 *
	 * {@inheritdoc}
	 *
	 */
	public function getBlockPrefix() {
		return 'junta';
	}
}

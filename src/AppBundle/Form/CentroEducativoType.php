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
				'required' => false
		) )->add ( 'nombre' , TextType::class, array (
				'required' => true
		) )->add ( 'telefono' , TextType::class, array (
				'required' => false
		) )->add ( 'junta' )->add ( 'direccion', DireccionType::class, array (
				'label_attr' => array (
						'class' => 'container_label' 
				),
				'attr' => array (
						'row_class' => 'container_row' 
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
		return 'bloque_centroeducativo';
	}
}

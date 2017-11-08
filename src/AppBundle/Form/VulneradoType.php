<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VulneradoType extends AbstractType {
	/**
	 *
	 * {@inheritdoc}
	 *
	 */
	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder->add ( 'identificacion' )->add ( 'nombres' )->add ( 'fechaNacimiento' )
		->add ( 'sexo' )->add ( 'genero' )->add ( 'nacionalidad' )->add ( 'interculturalidad' )
		->add ( 'ocupacion' )->add ( 'instruccion' )->add ( 'capacidadEspecial' )->add ( 'legalidad' )
		->add ( 'telefono' )->add ( 'email' )->add( 'centroEducativo' );
	}
	
	/**
	 *
	 * {@inheritdoc}
	 *
	 */
	public function configureOptions(OptionsResolver $resolver) {
		$resolver->setDefaults ( array (
				'data_class' => 'AppBundle\Entity\Vulnerado' 
		) );
	}
	
	/**
	 *
	 * {@inheritdoc}
	 *
	 */
	public function getBlockPrefix() {
		return 'bloque_vulnerado';
	}
}

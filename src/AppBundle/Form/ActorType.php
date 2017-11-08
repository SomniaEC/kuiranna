<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ActorType extends AbstractType {
	/**
	 *
	 * {@inheritdoc}
	 */
	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder->add ( 'tipo' )->add ( 'identificacion' )->add ( 'nombres' )->add ( 'telefono' )->add ( 'email' )->add ( 'identificacionContacto' )
		->add ( 'nombresContacto' )->add ( 'cargoContacto' )->add ( 'emailContacto' )->add ( 'fechaNacimiento' )
		->add ( 'sexo' )->add ( 'genero' )->add ( 'nacionalidad' )->add ( 'interculturalidad' )->add ( 'actividadEconomica' )
		->add ( 'lugarTrabajo' )->add ( 'institucion' )->add ( 'capacidadEspecial' )->add ( 'relacion' );
	}
	
	/**
	 *
	 * {@inheritdoc}
	 */
	public function configureOptions(OptionsResolver $resolver) {
		$resolver->setDefaults ( array (
				'data_class' => 'AppBundle\Entity\Actor' 
		) );
	}
	
	/**
	 *
	 * {@inheritdoc}
	 */
	public function getBlockPrefix() {
		return 'bloque_actor';
	}
}

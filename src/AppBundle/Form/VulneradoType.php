<?php

namespace AppBundle\Form;

use AppBundle\Utils\ConstantesDeGenero;
use AppBundle\Utils\ConstantesDeInterculturalidad;
use AppBundle\Utils\ConstantesDeLegalidad;
use AppBundle\Utils\ConstantesDeNivelInstruccion;
use AppBundle\Utils\ConstantesDeOcupacion;
use AppBundle\Utils\ConstantesDeSexo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VulneradoType extends AbstractType {
	/**
	 *
	 * {@inheritdoc}
	 *
	 */
	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder->add ( 'identificacion' )->add ( 'nombres' )->add ( 'fechaNacimiento' )->add ( 'sexo', ChoiceType::class, array (
				'choices' => ConstantesDeSexo::getConstants () 
		) )->add ( 'genero', ChoiceType::class, array (
				'choices' => ConstantesDeGenero::getConstants () 
		) )->add ( 'nacionalidad' )->add ( 'interculturalidad', ChoiceType::class, array (
				'choices' => ConstantesDeInterculturalidad::getConstants () 
		) )->add ( 'ocupacion', ChoiceType::class, array (
				'choices' => array_flip ( ConstantesDeOcupacion::getConstants () ) 
		) )->add ( 'instruccion', ChoiceType::class, array (
				'choices' => array_flip ( ConstantesDeNivelInstruccion::getConstants () ) 
		) )->add ( 'capacidadEspecial' )->add ( 'legalidad', ChoiceType::class, array (
				'choices' => ConstantesDeLegalidad::getConstants () 
		) )->add ( 'telefono' )->add ( 'email' )->add ( 'centroEducativo' );
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

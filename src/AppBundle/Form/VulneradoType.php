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
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class VulneradoType extends AbstractType {
	/**
	 *
	 * {@inheritdoc}
	 *
	 */
	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder->add ( 'identificacion' , TextType::class, array (
				'required' => false,
				'attr' => array (
						'maxlength' => '10'
				)
		) )->add ( 'nombres' , TextType::class, array (
				'required' => false,
				'attr' => array('class'=>'uppercase')
		) )->add ( 'fechaNacimiento', DateType::class, array (
				'widget' => 'single_text',
				'required' => false
		))->add ( 'sexo', ChoiceType::class, array (
				'choices' => array_flip ( ConstantesDeSexo::getConstants () )
		) )->add ( 'genero', ChoiceType::class, array (
				'choices' => array_flip ( ConstantesDeGenero::getConstants () )
		) )->add ( 'nacionalidad' , TextType::class, array (
				'required' => false
		) )->add ( 'interculturalidad', ChoiceType::class, array (
				'choices' => array_flip ( ConstantesDeInterculturalidad::getConstants () )
		) )->add ( 'ocupacion', ChoiceType::class, array (
				'choices' => array_flip ( ConstantesDeOcupacion::getConstants () )
		) )->add ( 'instruccion', ChoiceType::class, array (
				'choices' => array_flip ( ConstantesDeNivelInstruccion::getConstants () )
		) )->add ( 'capacidadEspecial' )->add ( 'legalidad', ChoiceType::class, array (
				'choices' => array_flip ( ConstantesDeLegalidad::getConstants () )
		) )->add ( 'telefono' , TextType::class, array (
				'required' => false,
				'attr' => array (
						'minlength' => '6',
						'maxlength' => '10'
				)
		) )->add ( 'email' , EmailType::class, array (
				'required' => false
		) )->add ( 'centroEducativo' );
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
		return 'vulnerado';
	}
}

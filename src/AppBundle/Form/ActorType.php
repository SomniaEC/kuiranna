<?php

namespace AppBundle\Form;

use AppBundle\Utils\ConstantesDeGenero;
use AppBundle\Utils\ConstantesDeInterculturalidad;
use AppBundle\Utils\ConstantesDeNivelInstruccion;
use AppBundle\Utils\ConstantesDeRelacion;
use AppBundle\Utils\ConstantesDeSexo;
use AppBundle\Utils\ConstantesDeTipoActor;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class ActorType extends AbstractType {
	/**
	 *
	 * {@inheritdoc}
	 */
	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder->add ( 'tipo', ChoiceType::class, array (
				'choices' => ConstantesDeTipoActor::getConstants ()
		) )->add ( 'identificacion', TextType::class, array (
				'attr' => array (
						'maxlength' => '13'
				),
				'required' => false 
		) )->add ( 'nombres', TextType::class, array (
				'required' => false,
				'attr' => array('class'=>'uppercase')
		) )->add ( 'telefono', TextType::class, array (
				'required' => false,
				'attr' => array (
						'maxlength' => '10'
				)
		) )->add ( 'email', EmailType::class, array (
				'required' => false
		) )->add ( 'fechaNacimiento', DateType::class, array (
				'widget' => 'single_text',
				'required' => false 
		) )->add ( 'edad', TextType::class, array (
				'mapped' => false,
				'attr' => array (
						'maxlength' => '3'
				),
				'required' => false 
		) )->add ( 'sexo', ChoiceType::class, array (
				'choices' => array_flip ( ConstantesDeSexo::getConstants () )
		) )->add ( 'genero', ChoiceType::class, array (
				'choices' => array_flip ( ConstantesDeGenero::getConstants () )
		) )->add ( 'nacionalidad', TextType::class, array (
				'required' => false 
		) )->add ( 'interculturalidad', ChoiceType::class, array (
				'choices' => array_flip ( ConstantesDeInterculturalidad::getConstants () ),
				'required' => true 
		) )->add ( 'actividadEconomica'
		)->add ( 'lugarTrabajo', TextType::class, array (
				'required' => false 
		) )->add ( 'instruccion', ChoiceType::class, array (
				'choices' => array_flip ( ConstantesDeNivelInstruccion::getConstants () )
		) )->add ( 'capacidadEspecial', CheckboxType::class, array (
				'required' => false 
		) )->add ( 'relacion', ChoiceType::class, array (
				'choices' => array_flip ( ConstantesDeRelacion::getConstants () ),
				'required' => true
		) )->add ( 'identificacionContacto', TextType::class, array (
				'required' => false,
				'attr' => array (
						'maxlength' => '10'
				),
		) )->add ( 'nombresContacto', TextType::class, array (
				'required' => false,
				'attr' => array('class'=>'uppercase')
		) )->add ( 'cargoContacto', TextType::class, array (
				'required' => false
		) )->add ( 'emailContacto', EmailType::class, array (
				'required' => false
		) )->add ( 'telefonoContacto', TextType::class, array (
				'required' => false,
				'attr' => array (
						'maxlength' => '10'
				)
		) );
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
		return 'actor';
	}
}

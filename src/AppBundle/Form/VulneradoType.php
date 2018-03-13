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

class VulneradoType extends AbstractType {
	/**
	 *
	 * {@inheritdoc}
	 *
	 */
	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder->add ( 'identificacion' , TextType::class, array (
				'required' => false
		) )->add ( 'nombres' , TextType::class, array (
				'required' => false
		) )->add ( 'fechaNacimiento', DateType::class, array (
				'widget' => 'single_text',
				'label_attr' => array (
						'class' => 'label'
				),
				'attr' => array (
						'row_class' => 'fecha_nacimiento'
				),
				'required' => false
		))->add ( 'sexo', ChoiceType::class, array (
				'choices' => ConstantesDeSexo::getConstants (),
				'required' => false
		) )->add ( 'genero', ChoiceType::class, array (
				'choices' => ConstantesDeGenero::getConstants (),
				'required' => false
		) )->add ( 'nacionalidad' , TextType::class, array (
				'required' => false
		) )->add ( 'interculturalidad', ChoiceType::class, array (
				'choices' => ConstantesDeInterculturalidad::getConstants (),
				'required' => false
		) )->add ( 'ocupacion', ChoiceType::class, array (
				'choices' => array_flip ( ConstantesDeOcupacion::getConstants () ),
				'required' => false
		) )->add ( 'instruccion', ChoiceType::class, array (
				'choices' => array_flip ( ConstantesDeNivelInstruccion::getConstants () ),
				'required' => false
		) )->add ( 'capacidadEspecial' )->add ( 'legalidad', ChoiceType::class, array (
				'choices' => ConstantesDeLegalidad::getConstants (),
				'required' => false
		) )->add ( 'telefono' , TextType::class, array (
				'required' => false
		) )->add ( 'email' , TextType::class, array (
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
		return 'bloque_vulnerado';
	}
}

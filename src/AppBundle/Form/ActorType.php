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
				'choices' => ConstantesDeTipoActor::getConstants (),
				'label_attr' => array (
						'class' => 'label'
				),
				'attr' => array (
						'row_class' => 'tipo'
				)
		) )->add ( 'identificacion', TextType::class, array (
				'label_attr' => array (
						'class' => 'label'
				),
				'attr' => array (
						'maxlength' => '13',
						'row_class' => 'identificacion'
				)
		) )->add ( 'nombres', TextType::class, array (
				'label_attr' => array (
						'class' => 'label'
				),
				'attr' => array (
						'row_class' => 'nombres'
				)
		) )->add ( 'telefono', TextType::class, array (
				'label_attr' => array (
						'class' => 'label'
				),
				'attr' => array (
						'row_class' => 'telefono'
				)
		) )->add ( 'email', EmailType::class, array (
				'label_attr' => array (
						'class' => 'label'
				),
				'attr' => array (
						'row_class' => 'email'
				)
		) )->add ( 'identificacionContacto', TextType::class, array (
				'label_attr' => array (
						'class' => 'label'
				),
				'attr' => array (
						'row_class' => 'identificacion_contacto'
				)
		) )->add ( 'nombresContacto', TextType::class, array (
				'label_attr' => array (
						'class' => 'label'
				),
				'attr' => array (
						'row_class' => 'nombres_contacto'
				)
		) )->add ( 'cargoContacto', TextType::class, array (
				'label_attr' => array (
						'class' => 'label'
				),
				'attr' => array (
						'row_class' => 'cargo_contacto'
				)
		) )->add ( 'emailContacto', EmailType::class, array (
				'label_attr' => array (
						'class' => 'label'
				),
				'attr' => array (
						'row_class' => 'email_contacto'
				)
		) )->add ( 'telefonoContacto', TextType::class, array (
				'label_attr' => array (
						'class' => 'label'
				),
				'attr' => array (
						'row_class' => 'telefono_contacto'
				)
		) )->add ( 'fechaNacimiento', DateType::class, array (
				'widget' => 'single_text',
				'label_attr' => array (
						'class' => 'label'
				),
				'attr' => array (
						'row_class' => 'fecha_nacimiento'
				)
		) )->add ( 'edad', TextType::class, array (
				'mapped' => false,
				'required' => false,
				'label_attr' => array (
						'class' => 'label'
				),
				'attr' => array (
						'row_class' => 'edad'
				)
		) )->add ( 'sexo', ChoiceType::class, array (
				'choices' => ConstantesDeSexo::getConstants (),
				'label_attr' => array (
						'class' => 'label'
				),
				'attr' => array (
						'row_class' => 'sexo'
				)
		) )->add ( 'genero', ChoiceType::class, array (
				'choices' => ConstantesDeGenero::getConstants (),
				'label_attr' => array (
						'class' => 'label'
				),
				'attr' => array (
						'row_class' => 'genero'
				)
		) )->add ( 'nacionalidad', TextType::class, array (
				'label_attr' => array (
						'class' => 'label'
				),
				'attr' => array (
						'row_class' => 'nacionalidad'
				)
		) )->add ( 'interculturalidad', ChoiceType::class, array (
				'choices' => ConstantesDeInterculturalidad::getConstants (),
				'label_attr' => array (
						'class' => 'label'
				),
				'attr' => array (
						'row_class' => 'interculturalidad'
				)
		) )->add ( 'actividadEconomica', ActividadEconomicaType::class, array (
				'label_attr' => array (
						'class' => 'container_label'
				),
				'attr' => array (
						'row_class' => 'container_row actividad_economica'
				)
		) )->add ( 'lugarTrabajo', TextType::class, array (
				'label_attr' => array (
						'class' => 'label'
				),
				'attr' => array (
						'row_class' => 'lugar_trabajo'
				)
		) )->add ( 'instruccion', ChoiceType::class, array (
				'choices' => array_flip ( ConstantesDeNivelInstruccion::getConstants () ),
				'label_attr' => array (
						'class' => 'label'
				),
				'attr' => array (
						'row_class' => 'instruccion'
				)
		) )->add ( 'capacidadEspecial', CheckboxType::class, array (
				'required' => false,
				'label_attr' => array (
						'class' => 'label'
				),
				'attr' => array (
						'row_class' => 'capacidad_especial'
				)
		) )->add ( 'relacion', ChoiceType::class, array (
				'choices' => array_flip ( ConstantesDeRelacion::getConstants () ),
				'label_attr' => array (
						'class' => 'label'
				),
				'attr' => array (
						'row_class' => 'relacion'
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
		return 'bloque_actor';
	}
}

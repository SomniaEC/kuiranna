<?php

namespace AppBundle\Form;

use AppBundle\Utils\ConstantesDeRolActor;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ActorDireccionType extends AbstractType {
	/**
	 *
	 * {@inheritdoc}
	 *
	 */
	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder->add ( 'rol', ChoiceType::class, array (
				'choices' => ConstantesDeRolActor::getConstants (),
				'label_attr' => array (
						'class' => 'label' 
				),
				'attr' => array (
						'row_class' => 'rol' 
				) 
		) )->add ( 'actor', ActorType::class, array (
				'label_attr' => array (
						'class' => 'container_label' 
				),
				'attr' => array (
						'row_class' => 'container_row' 
				) 
		) )->add ( 'direccion', DireccionType::class, array (
				'label_attr' => array (
						'class' => 'container_label' 
				),
				'attr' => array (
						'row_class' => 'container_row elementos_direccion direccion' 
				) 
		) )->add ( 'direccionTrabajo', DireccionType::class, array (
				'label_attr' => array (
						'class' => 'container_label' 
				),
				'attr' => array (
						'row_class' => 'container_row elementos_direccion direccion_trabajo' 
				) 
		) )->add ( 'denuncia' )->add ( 'junta' );
	}
	
	/**
	 *
	 * {@inheritdoc}
	 *
	 */
	public function configureOptions(OptionsResolver $resolver) {
		$resolver->setDefaults ( array (
				'data_class' => 'AppBundle\Entity\ActorDireccion' 
		) );
	}
	
	/**
	 *
	 * {@inheritdoc}
	 *
	 */
	public function getBlockPrefix() {
		return 'bloque_actordireccion';
	}
}

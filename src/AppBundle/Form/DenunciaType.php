<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DenunciaType extends AbstractType {
	/**
	 *
	 * {@inheritdoc}
	 *
	 */
	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder->add ( 'creacion' )->add ( 'hechos' )->add ( 'recursoImpugnacion' )
		->add ( 'tipoMaltrato' )->add ( 'ambitoMaltrato' )->add ( 'vulneradoresDerechos' )
		->add ( 'derechos' )->add ( 'junta' )->add ( 'vulneradosDireccion', CollectionType::class, array (
				'entry_type' => VulneradoDireccionTodoType::class,
				'allow_add' => false,
				'allow_delete' => true,
				'label_attr' => array (
						'class' => 'container_label' 
				),
				'attr' => array (
						'row_class' => 'container_container_row vulnerados_direccion' 
				) 
		
		) );
		$builder->add ( 'actoresDireccion', CollectionType::class, array (
				'entry_type' => ActorDireccionTodoType::class,
				'allow_add' => false,
				'allow_delete' => true,
				'label_attr' => array (
						'class' => 'container_label' 
				),
				'attr' => array (
						'row_class' => 'container_container_row actores_direccion' 
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
				'data_class' => 'AppBundle\Entity\Denuncia' 
		) );
	}
	
	/**
	 *
	 * {@inheritdoc}
	 *
	 */
	public function getBlockPrefix() {
		return 'bloque_denuncia';
	}
}

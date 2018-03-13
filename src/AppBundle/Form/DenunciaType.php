<?php

namespace AppBundle\Form;

use AppBundle\Utils\ConstantesDeAmbitoMaltrato;
use AppBundle\Utils\ConstantesDeTipoMaltrato;
use AppBundle\Utils\ConstantesDeVulneradorDerecho;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class DenunciaType extends AbstractType {
	/**
	 *
	 * {@inheritdoc}
	 *
	 */
	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder->add ( 'creacion' )->add ( 'hechos', TextType::class, array (
				'required' => false 
		) )->add ( 'recursoImpugnacion', TextType::class, array (
				'required' => false 
		) )->add ( 'tipoMaltrato', ChoiceType::class, array (
				'choices' => array_flip ( ConstantesDeTipoMaltrato::getConstants () ) 
		) )->add ( 'ambitoMaltrato', ChoiceType::class, array (
				'choices' => ConstantesDeAmbitoMaltrato::getConstants () 
		) )->add ( 'vulneradoresDerechos', ChoiceType::class, array (
				'choices' => array_flip ( ConstantesDeVulneradorDerecho::getConstants () ),
				'multiple' => true,
				'required' => false
		) )->add ( 'derechos' )->add ( 'junta' )->add ( 'vulneradosDireccion', CollectionType::class, array (
				'entry_type' => VulneradoDireccionTodoType::class,
				'allow_add' => true,
				'allow_delete' => true,
				'label_attr' => array (
						'class' => 'container_label vulnerados_label',
						'label_row_class' => 'vulnerado_label' 
				),
				'attr' => array (
						'row_class' => 'container_container_row vulnerados_direccion',
						'element_row_class' => 'vulnerado_direccion_row',
						'element_row_id' => 'vulnerado_direccion_id'
				) 
		
		) );
		$builder->add ( 'actoresDireccion', CollectionType::class, array (
				'entry_type' => ActorDireccionTodoType::class,
				'allow_add' => true,
				'allow_delete' => true,
				'label_attr' => array (
						'class' => 'container_label actores_label',
						'label_row_class' => 'actor_label' 
				),
				'attr' => array (
						'row_class' => 'container_container_row actores_direccion',
						'element_row_class' => 'actor_direccion_row',
						'element_row_id' => 'actor_direccion_id' 
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
		return 'denuncia';
	}
}

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
		) )->add ( 'derechos' )->add ( 'vulneradosDireccion', CollectionType::class, array (
				'entry_type' => VulneradoDireccionTodoType::class,
				'allow_add' => true,
				'allow_delete' => true	
		) );
		$builder->add ( 'actoresDireccion', CollectionType::class, array (
				'entry_type' => ActorDireccionTodoType::class,
				'allow_add' => true,
				'allow_delete' => true
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

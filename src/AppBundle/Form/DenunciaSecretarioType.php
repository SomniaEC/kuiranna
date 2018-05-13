<?php

namespace AppBundle\Form;

use AppBundle\Entity\Derecho;
use AppBundle\Utils\ConstantesDeAmbitoMaltrato;
use AppBundle\Utils\ConstantesDeRecursoImpugnacion;
use AppBundle\Utils\ConstantesDeTipoMaltrato;
use AppBundle\Utils\ConstantesDeVulneradorDerecho;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DenunciaSecretarioType extends AbstractType {
	
	/**
	 *
	 * {@inheritdoc}
	 *
	 */
	public function buildForm(FormBuilderInterface $builder, array $options) {
		$this->junta = $options['junta'];
		$builder->add('creacion', DateType::class, array (
				'disabled' => 'disabled'
		) )->add ( 'hechos', TextareaType::class, array (
				'required' => false
		) )->add ( 'recursoImpugnacion', ChoiceType::class, array (
				'choices' => array_flip ( ConstantesDeRecursoImpugnacion::getConstants () ) ,
				'required' => false,
				'disabled' => 'disabled'
		) )->add ( 'tipoMaltrato', ChoiceType::class, array (
				'choices' => array_flip ( ConstantesDeTipoMaltrato::getConstants () ) 
		) )->add ( 'ambitoMaltrato', ChoiceType::class, array (
				'choices' => array_flip ( ConstantesDeAmbitoMaltrato::getConstants () )
		) )->add ( 'vulneradoresDerechos', ChoiceType::class, array (
				'choices' => array_flip ( ConstantesDeVulneradorDerecho::getConstants () ),
				'multiple' => true,
				'expanded' => true,
				'required' => false
		) )->add ( 'derechos' , EntityType::class, array (
				'class' => Derecho::class,
				'multiple' => true,
				'expanded' => true,
				'choice_attr' => function (Derecho $derecho, $key, $index) {
					return ['data-tooltip' => $derecho->getDescripcion() ];
				}	
		) )->add ( 'vulneradosDireccion', CollectionType::class, array (
				'entry_type' => VulneradoDireccionTodoType::class,
				'allow_add' => true,
				'allow_delete' => true 
		) )->add ( 'actoresDireccion', CollectionType::class, array (
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
				'data_class' => 'AppBundle\Entity\Denuncia',
				'junta' => null,
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

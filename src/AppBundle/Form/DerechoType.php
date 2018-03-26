<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use AppBundle\Utils\ConstantesDeTipoDerechoVulnerado;

class DerechoType extends AbstractType {
	/**
	 *
	 * {@inheritdoc}
	 */
	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder->add ( 'tipo', ChoiceType::class, array (
				'choices' => array_flip ( ConstantesDeTipoDerechoVulnerado::getConstants () )
		) )->add ( 'nombre' )->add ( 'descripcion', TextType::class, array (
				'required' => false 
		) );
	}
	
	/**
	 *
	 * {@inheritdoc}
	 */
	public function configureOptions(OptionsResolver $resolver) {
		$resolver->setDefaults ( array (
				'data_class' => 'AppBundle\Entity\Derecho' 
		) );
	}
	
	/**
	 *
	 * {@inheritdoc}
	 */
	public function getBlockPrefix() {
		return 'derecho';
	}
}

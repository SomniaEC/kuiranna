<?php

namespace AppBundle\Form;

use AppBundle\Entity\PersonaDomicilio;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DenunciaTodoType extends AbstractType {
	/**
	 *
	 * {@inheritdoc}
	 *
	 */
	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder->add ( 'fechaRegistro' )->add ( 'hechos' )->add ( 'derechos' )->add ( 'junta' );
		$builder->add ( 'personasDomicilio', CollectionType::class, array (
				'entry_type' => PersonaDomicilio::class 
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
		return 'appbundle_denuncia';
	}
}

<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;

class CentroEducativoTodoType extends AbstractType {
	public function __construct(EntityManager $em) {
		$this->em = $em;
	}
	
	/**
	 *
	 * {@inheritdoc}
	 */
	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder->add ( 'identificacion', TextType::class, array (
				'required' => false,
				'attr' => array (
						'maxlength' => '13' 
				) 
		) )->add ( 'nombre', TextType::class, array (
				'required' => true,
				'attr' => array (
						'class' => 'uppercase' 
				) 
		) )->add ( 'telefono', TextType::class, array (
				'required' => false,
				'attr' => array (
						'maxlength' => '10' 
				) 
		) )->add ( 'junta' )->add ( 'direccion', DireccionType::class, array (
				'label_attr' => array (
						'class' => 'container_label' 
				),
				'attr' => array (
						'class' => 'container_value' 
				) 
		) );
	}
	public function getJuntas() {
		$juntas = $this->em->getRepository ( 'AppBundle:Junta' )->findAll ();
		$resultado = array ();
		foreach ( $juntas as $junta ) {
			$direccion = $junta->getDireccion ();
			if ($direccion != null && $direccion->getProvincia () != null && $direccion->getCanton () != null && $direccion->getParroquia () != null) {
				$resultado [$junta->getId ()] = array (
						$direccion->getProvincia (),
						$direccion->getCanton (),
						$direccion->getParroquia ()
				);
			}
		}
		return $resultado;
	}
	
	/**
	 *
	 * {@inheritdoc}
	 */
	public function buildView(FormView $view, FormInterface $form, array $options) {
		$view->vars ['junta_direccion'] = json_encode ( $this->getJuntas () );
	}
	
	/**
	 *
	 * {@inheritdoc}
	 */
	public function configureOptions(OptionsResolver $resolver) {
		$resolver->setDefaults ( array (
				'data_class' => 'AppBundle\Entity\CentroEducativo' 
		) );
	}
	
	/**
	 *
	 * {@inheritdoc}
	 */
	public function getBlockPrefix() {
		return 'centroeducativo';
	}
}

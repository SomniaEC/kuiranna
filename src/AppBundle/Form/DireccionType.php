<?php

namespace AppBundle\Form;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;

class DireccionType extends AbstractType {
	private $em;
	private $provincias;
	private $cantones;
	private $parroquias;
	public function __construct(EntityManager $em) {
		$this->em = $em;
	}
	
	/**
	 *
	 * {@inheritdoc}
	 */
	public function buildForm(FormBuilderInterface $builder, array $options) {
		$this->provincias = $this->getProvincias ();
		$this->cantones = $this->getCantones ();
		$this->parroquias = $this->getParroquias ();
		$builder->add ( 'provincia', ChoiceType::class, array (
				'choices' => $this->provincias ['nombres'],
				'choice_attr' => function ($provincia, $key, $index) {
					return [ 
							'data-codigo' => $this->provincias ['codigos'] [$provincia] 
					];
				},
				'attr' => array (
						'class' => 'select_direccion_provincia' 
				) 
		) );
		$builder->add ( 'canton', ChoiceType::class, array (
				'choices' => $this->cantones ['nombres'],
				'choice_attr' => function ($canton, $key, $index) {
					return [ 
							'data-codigo' => $this->cantones ['codigos'] [$canton] 
					];
				},
				'attr' => array (
						'class' => 'select_direccion_canton' 
				) 
		) )->add ( 'parroquia', ChoiceType::class, array (
				'choices' => $this->parroquias ['nombres'],
				'choice_attr' => function ($parroquia, $key, $index) {
					return [ 
							'data-codigo' => $this->parroquias ['codigos'] [$parroquia] 
					];
				},
				'attr' => array (
						'class' => 'select_direccion_parroquia' 
				) 
		) )->add ( 'sector' )->add ( 'zona' )->add ( 'callePrincipal' )->add ( 'calleSecundaria' )->add ( 'numero' )->add ( 'referencia' );
	}
	public function getProvincias() {
		$provincias = $this->em->getRepository ( 'AppBundle:Provincia' )->findAll ();
		$resultado = array (
				'nombres' => array (),
				'codigos' => array () 
		);
		foreach ( $provincias as $provincia ) {
			$resultado ['nombres'] += array (
					$provincia->getNombre () => $provincia->getNombre () 
			);
			$resultado ['codigos'] += array (
					$provincia->getNombre () => $provincia->getCodigo () 
			);
		}
		return $resultado;
	}
	public function getCantones() {
		$cantones = $this->em->getRepository ( 'AppBundle:Canton' )->findAll ();
		$resultado = array (
				'nombres' => array (),
				'codigos' => array (),
				'prov_canton' => array () 
		);
		foreach ( $cantones as $canton ) {
			$codigo = $canton->getProvincia ()->getCodigo ();
			$resultado ['nombres'] += array (
					$canton->getNombre () => $canton->getNombre () 
			);
			$resultado ['codigos'] += array (
					$canton->getNombre () => $codigo . $canton->getCodigo () 
			);
			if (isset ( $resultado ['prov_canton'] [$codigo] )) {
				$resultado ['prov_canton'] [$codigo] += array (
						$canton->getCodigo () => $canton->getNombre () 
				);
			} else {
				$resultado ['prov_canton'] [$codigo] = array (
						$canton->getCodigo () => $canton->getNombre () 
				);
			}
		}
		return $resultado;
	}
	public function getParroquias() {
		$parroquias = $this->em->getRepository ( 'AppBundle:Parroquia' )->findAll ();
		$resultado = array (
				'nombres' => array (),
				'codigos' => array (),
				'canton_parroquia' => array () 
		);
		foreach ( $parroquias as $parroquia ) {
			$codigo = $parroquia->getCanton ()->getProvincia ()->getCodigo () . $parroquia->getCanton ()->getCodigo ();
			$resultado ['nombres'] += array (
					$parroquia->getNombre () => $parroquia->getNombre () 
			);
			$resultado ['codigos'] += array (
					$parroquia->getNombre () => $codigo . $parroquia->getCodigo () 
			);
			if (isset ( $resultado ['canton_parroquia'] [$codigo] )) {
				$resultado ['canton_parroquia'] [$codigo] += array (
						$parroquia->getCodigo () => $parroquia->getNombre () 
				);
			} else {
				$resultado ['canton_parroquia'] [$codigo] = array (
						$parroquia->getCodigo () => $parroquia->getNombre () 
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
		$view->vars ['provincia_canton'] = json_encode ( $this->cantones ['prov_canton'] );
		$view->vars ['canton_parroquia'] = json_encode ( $this->parroquias ['canton_parroquia'] );
	}
	
	/**
	 *
	 * {@inheritdoc}
	 */
	public function configureOptions(OptionsResolver $resolver) {
		$resolver->setDefaults ( array (
				'data_class' => 'AppBundle\Entity\Direccion' 
		) );
	}
	
	/**
	 *
	 * {@inheritdoc}
	 */
	public function getBlockPrefix() {
		return 'bloque_direccion';
	}
}

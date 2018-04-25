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
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use AppBundle\Entity\Junta;
use AppBundle\Utils\ConstantesDeRecursoImpugnacion;
use AppBundle\Entity\Usuario;
use Doctrine\ORM\EntityRepository;
use AppBundle\Utils\ConstantesDeRolUsuario;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class DenunciaType extends AbstractType {
	
	/**
	 *
	 * {@inheritdoc}
	 *
	 */
	public function buildForm(FormBuilderInterface $builder, array $options) {
		$this->junta = $options['junta'];
		$builder->add ( 'hechos', TextareaType::class, array (
				'required' => false 
		) )->add ( 'recursoImpugnacion', ChoiceType::class, array (
				'choices' => array_flip ( ConstantesDeRecursoImpugnacion::getConstants () ) ,
				'required' => false 
		) )->add ( 'fechaAudiencia', DateType::class, array (
				'required' => false
		) )->add ( 'tipoMaltrato', ChoiceType::class, array (
				'choices' => array_flip ( ConstantesDeTipoMaltrato::getConstants () ) 
		) )->add ( 'ambitoMaltrato', ChoiceType::class, array (
				'choices' => array_flip ( ConstantesDeAmbitoMaltrato::getConstants () )
		) )->add ( 'vulneradoresDerechos', ChoiceType::class, array (
				'choices' => array_flip ( ConstantesDeVulneradorDerecho::getConstants () ),
				'multiple' => true,
				'required' => false
		) )->add ( 'derechos' )->add ( 'vulneradosDireccion', CollectionType::class, array (
				'entry_type' => VulneradoDireccionTodoType::class,
				'allow_add' => true,
				'allow_delete' => true 
		) )->add ( 'responsable', EntityType::class, array (
				'class' => Usuario::class,
				'query_builder' => function (EntityRepository $er) {
					return $er->createQueryBuilder('u')
						->where('u.junta = :junta')
						->andWhere('u.rol = :rol')
						->setParameters(array('junta' => $this->junta, 'rol' => ConstantesDeRolUsuario::Miembro_Junta));
				},
				'required' => false
		) )->add ( 'observaciones', TextareaType::class, array (
				'required' => false
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

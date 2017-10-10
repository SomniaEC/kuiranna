<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UsuarioType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {	
    	
        $builder->add('cedula')
        ->add('username')
        ->add('plainPassword', RepeatedType::class, array(
        		'type' => PasswordType::class,
        		'first_options'  => array('label' => 'Password'),
        		'second_options' => array('label' => 'Repeat Password'),
        ))
        ->add('telefonoConvencional')
        ->add('telefonoCelular')
        ->add('email')
        ->add('cargo')
        ->add('fechaInicio')
        ->add('fechaFin')
        ->add('estadoActividad')
        ->add('enabled')
        ->add('lastLogin')
        ->add('passwordRequestedAt')
        ->add('roles')
        ->add('confirmationToken')
        ->add('junta');
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Usuario'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_usuario';
    }


}

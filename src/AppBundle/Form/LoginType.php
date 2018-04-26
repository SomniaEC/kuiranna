<?php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use AppBundle\Entity\Junta;

class LoginType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $juntas = array(
            // adds null field
            'required' => false,
            'empty_data' => null,
            // looks for choices from this entity
            'class' => Junta::class,
            // uses the Junta.nombre property as the visible option string
            'choice_label' => 'nombre'
        );
        
        $builder->add('_username');
        $builder->add('_password', PasswordType::class);
        $builder->add('_junta', EntityType::class, $juntas);
    }
}

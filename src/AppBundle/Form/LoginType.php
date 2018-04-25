<?php

namespace AppBundle\Form;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use AppBundle\Entity\Junta;

class LoginType extends AbstractType
{
    public function __construct(EntityManager $em) {
        $this->em = $em;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('_username');
        $builder->add('_password', PasswordType::class);
        $builder->add('_junta', EntityType::class, array(
            // looks for choices from this entity
            'class' => Junta::class,
            // uses the Junta.nombre property as the visible option string
            'choice_label' => 'nombre'
        ));
    }
    

}

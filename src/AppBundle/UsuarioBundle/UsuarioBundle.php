<?php
namespace AppBundle\UsuarioBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class UsuarioBundle extends Bundle
{

    public function getParent()
    {
        return 'FOSUserBundle';
    }
}


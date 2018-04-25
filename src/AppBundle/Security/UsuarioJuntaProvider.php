<?php
namespace AppBundle\Security;

use AppBundle\Entity\Usuario;
use FOS\UserBundle\Security\UserProvider;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;

class UsuarioJuntaProvider extends UserProvider
{

    public function __construct($juntaId)
    {
        $this->junta = $juntaId;
    }

    public function loadUserByUsername($username)
    {
        $user = $this->userManager->findUserBy(array(
            'username' => $username));
        
        if (! $user) {
            throw new UsernameNotFoundException(sprintf('Username "%s" does not exist.', $username));
        }
        
        if($user->hasRole($role))
        
        return $user;
    }

    public function refreshUser(UserInterface $user)
    {
        if (! $user instanceof Usuario) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', get_class($user)));
        }
        
        return $this->loadUserByUsername($user->getUsername());
    }

    public function supportsClass($class)
    {
        return Usuario::class === $class;
    }
}
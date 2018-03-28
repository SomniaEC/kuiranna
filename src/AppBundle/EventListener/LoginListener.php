<?php
namespace AppBundle\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\AuthenticationEvents;
use Symfony\Component\Security\Core\Event\AuthenticationFailureEvent;
use Symfony\Component\Security\Core\Event\AuthenticationEvent;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;

class LoginListener implements EventSubscriberInterface
{

    /**
     * getSubscribedEvents
     *
     * @author Joe Sexton <joe@webtipblog.com>
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return array(
            AuthenticationEvents::AUTHENTICATION_FAILURE => 'onAuthenticationFailure',
            AuthenticationEvents::AUTHENTICATION_SUCCESS => 'onAuthenticationSuccess'
        );
    }

    /**
     * onAuthenticationFailure
     *
     * @author Joe Sexton <joe@webtipblog.com>
     * @param AuthenticationFailureEvent $event
     */
    public function onAuthenticationFailure(AuthenticationFailureEvent $event)
    {
        // executes on failed login
    }

    /**
     * onAuthenticationSuccess
     *
     * @author Joe Sexton <joe@webtipblog.com>
     * @param InteractiveLoginEvent $event
     */
    public function onAuthenticationSuccess(AuthenticationEvent $event)
    {

    }

    public function onSecurityInteractiveLogin(InteractiveLoginEvent $event)
    {
    	//get authenticated user
        $token = $event->getAuthenticationToken();
        $user=$token->getUser();
        
        //get session
        $request = $event->getRequest();
        $session = $request->getSession();

        // set session attributes
        $session->set('user_rol', $user->getRol());
        $session->set('junta', $user->getJunta());
    }
}
?>
<?php

namespace Zenstruck\ControllerUtilBundle\Tests\Functional\Fixtures\Controller;

use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBag;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\SecurityContext;

/**
 * @author Kevin Bond <kevinbond@gmail.com>
 */
class ParamConverterTestController
{
    public function sessionAction(Session $session)
    {
        return new Response(get_class($session));
    }

    public function flashBagAction(FlashBag $flashBag)
    {
        return new Response(get_class($flashBag));
    }

    public function formFactoryAction(FormFactory $formFactory)
    {
        return new Response(get_class($formFactory));
    }

    public function securityContextAction(SecurityContext $securityContext)
    {
        return new Response(get_class($securityContext));
    }
}

<?php

namespace Zenstruck\ControllerUtilBundle\Tests\Functional\Fixtures\Controller;

use Symfony\Component\HttpFoundation\Response;
use Zenstruck\ControllerUtil\FlashRedirect;
use Zenstruck\ControllerUtil\Forward;
use Zenstruck\ControllerUtil\Redirect;
use Zenstruck\ControllerUtil\Template;
use Zenstruck\ControllerUtil\View;

/**
 * @author Kevin Bond <kevinbond@gmail.com>
 */
class ResponderTestController
{
    public function forwardAction()
    {
        return new Forward('responder.test.controller:forwardEndpointAction');
    }

    public function forwardEndpointAction()
    {
        return new Response('Forwarded.');
    }

    public function redirectAction()
    {
        return new Redirect('redirect_endpoint');
    }

    public function flashRedirectAction()
    {
        return FlashRedirect::createSimple('redirect_endpoint', 'This is a flash message.');
    }

    public function redirectEndpointAction()
    {
        return new Response('Redirected.');
    }

    public function viewAction()
    {
        return new Template('@Test/view.html.twig', 'foo');
    }

    public function nullViewAction()
    {
        return new View(null);
    }

    public function nullAction()
    {
        return null;
    }
}

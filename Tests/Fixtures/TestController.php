<?php

namespace Zenstruck\ControllerUtilBundle\Tests\Fixtures;

use Symfony\Component\HttpFoundation\Response;
use Zenstruck\ControllerUtil\FlashRedirect;
use Zenstruck\ControllerUtil\Forward;
use Zenstruck\ControllerUtil\Redirect;
use Zenstruck\ControllerUtil\Template;

/**
 * @author Kevin Bond <kevinbond@gmail.com>
 */
class TestController
{
    public function forwardAction()
    {
        return new Forward('test.controller:forwardEndpointAction');
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
}

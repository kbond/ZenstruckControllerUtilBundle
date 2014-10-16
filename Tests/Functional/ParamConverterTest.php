<?php

namespace Zenstruck\ControllerUtilBundle\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * @author Kevin Bond <kevinbond@gmail.com>
 */
class ParamConverterTest extends WebTestCase
{
    public function testSession()
    {
        $client = static::createClient();
        $client->request('GET', '/session');

        $this->assertSame(200, $client->getResponse()->getStatusCode());
        $this->assertSame('Symfony\Component\HttpFoundation\Session\Session', $client->getResponse()->getContent());
    }

    public function testFlashBag()
    {
        $client = static::createClient();
        $client->request('GET', '/flash_bag');

        $this->assertSame(200, $client->getResponse()->getStatusCode());
        $this->assertSame('Symfony\Component\HttpFoundation\Session\Flash\FlashBag', $client->getResponse()->getContent());
    }

    public function testFormFactory()
    {
        $client = static::createClient();
        $client->request('GET', '/form_factory');

        $this->assertSame(200, $client->getResponse()->getStatusCode());
        $this->assertSame('Symfony\Component\Form\FormFactory', $client->getResponse()->getContent());
    }

    public function testSecurityContext()
    {
        $client = static::createClient();
        $client->request('GET', '/security_context');

        $this->assertSame(200, $client->getResponse()->getStatusCode());
        $this->assertSame('Symfony\Component\Security\Core\SecurityContext', $client->getResponse()->getContent());
    }
}

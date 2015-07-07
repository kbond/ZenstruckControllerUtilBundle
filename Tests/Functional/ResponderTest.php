<?php

namespace Zenstruck\ControllerUtilBundle\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;

/**
 * @author Kevin Bond <kevinbond@gmail.com>
 */
class ResponderTest extends WebTestCase
{
    public function testForward()
    {
        $client = static::createClient();
        $client->request('GET', '/forward');

        $this->assertSame('Forwarded.', $client->getResponse()->getContent());
    }

    public function testRedirect()
    {
        $client = static::createClient();
        $client->followRedirects(false);
        $client->request('GET', '/redirect');
        $response = $client->getResponse();

        $this->assertTrue($response->isRedirect('/redirect-endpoint'));
        $this->assertSame(302, $response->getStatusCode());

        $client->followRedirect();

        $this->assertSame('Redirected.', $client->getResponse()->getContent());
    }

    public function testFlashRedirect()
    {
        $client = static::createClient();
        $client->followRedirects(false);

        $this->assertFalse($this->getFlashBag()->has('info'));

        $client->request('GET', '/flash-redirect');
        $response = $client->getResponse();

        $this->assertTrue($response->isRedirect('/redirect-endpoint'));
        $this->assertSame(302, $response->getStatusCode());
        $this->assertTrue($this->getFlashBag()->has('info'));
        $this->assertSame(array('This is a flash message.'), $this->getFlashBag()->get('info'));

        $client->followRedirect();

        $this->assertSame('Redirected.', $client->getResponse()->getContent());
    }

    /**
     * @dataProvider viewDataProvider
     */
    public function testView($uri, $expectedContent, $expectedContentType)
    {
        $client = static::createClient();
        $client->request('GET', $uri);
        $response = $client->getResponse();

        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame($expectedContent, $response->getContent());
        $this->assertSame($expectedContentType, $response->headers->get('content-type'));
    }

    public function testNullView()
    {
        $client = static::createClient();
        $client->request('GET', '/null-view');
        $response = $client->getResponse();
        $this->assertSame(204, $response->getStatusCode());
        $this->assertSame('', $response->getContent());
    }

    public function testNull()
    {
        $client = static::createClient();
        $client->request('GET', '/null');
        $response = $client->getResponse();
        $this->assertSame(204, $response->getStatusCode());
        $this->assertSame('', $response->getContent());
    }

    public function viewDataProvider()
    {
        return array(
            array('/view', "This is a rendered view with data: foo\n", 'text/html; charset=UTF-8'),
            array('/view.json', '"foo"', 'application/json'),
            array('/view.xml', "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<result><![CDATA[foo]]></result>\n", 'text/xml; charset=UTF-8'),
        );
    }

    /**
     * @return FlashBagInterface
     */
    private function getFlashBag()
    {
        return self::$kernel->getContainer()->get('session')->getFlashBag();
    }
}

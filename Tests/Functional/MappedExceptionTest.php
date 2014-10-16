<?php

namespace Zenstruck\ControllerUtilBundle\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * @author Kevin Bond <kevinbond@gmail.com>
 */
class MappedExceptionTest extends WebTestCase
{
    public function testMappedException()
    {
        $client = static::createClient();
        $client->request('GET', '/mapped_exception');

        $this->assertSame(503, $client->getResponse()->getStatusCode());
    }

    public function testNonMappedException()
    {
        $client = static::createClient();
        $client->request('GET', '/non_mapped_exception');

        $this->assertSame(500, $client->getResponse()->getStatusCode());
    }
}

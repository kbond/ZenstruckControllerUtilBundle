<?php

namespace Zenstruck\ControllerUtilBundle\Tests\DependencyInjection;

use Matthias\SymfonyDependencyInjectionTest\PhpUnit\AbstractExtensionTestCase;
use Zenstruck\ControllerUtilBundle\DependencyInjection\ZenstruckControllerUtilExtension;

/**
 * @author Kevin Bond <kevinbond@gmail.com>
 */
class ZenstruckControllerUtilExtensionTest extends AbstractExtensionTestCase
{
    public function testDefault()
    {
        $this->setParameter('kernel.bundles', array());
        $this->load();
        $this->compile();

        $this->assertTrue($this->container->has('zenstruck_controller_util.forward_listener'));
        $this->assertTrue($this->container->has('zenstruck_controller_util.redirect_listener'));
        $this->assertTrue($this->container->has('zenstruck_controller_util.templating_view_listener'));
        $this->assertTrue($this->container->has('zenstruck_controller_util.has_flashes_listener'));
        $this->assertFalse($this->container->has('zenstruck_controller_util.serializer_view_listener'));
    }

    public function testJmsSerializerBundle()
    {
        $this->setParameter('kernel.bundles', array('JMSSerializerBundle' => 'JMSSerializerBundle'));
        $this->load();
        $this->compile();

        $this->assertTrue($this->container->has('zenstruck_controller_util.forward_listener'));
        $this->assertTrue($this->container->has('zenstruck_controller_util.redirect_listener'));
        $this->assertTrue($this->container->has('zenstruck_controller_util.templating_view_listener'));
        $this->assertTrue($this->container->has('zenstruck_controller_util.has_flashes_listener'));
        $this->assertTrue($this->container->has('zenstruck_controller_util.serializer_view_listener'));
    }

    protected function getContainerExtensions()
    {
        return array(new ZenstruckControllerUtilExtension());
    }
}

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
        $this->load();
        $this->compile();

        $this->assertTrue($this->container->has('zenstruck_controller_util.forward_listener'));
        $this->assertTrue($this->container->has('zenstruck_controller_util.redirect_listener'));
        $this->assertTrue($this->container->has('zenstruck_controller_util.templating_view_listener'));
        $this->assertTrue($this->container->has('zenstruck_controller_util.no_content_view_listener'));
        $this->assertTrue($this->container->has('zenstruck_controller_util.has_flashes_listener'));
        $this->assertTrue($this->container->has('zenstruck_controller_util.param_converter_listener'));
        $this->assertTrue($this->container->has('zenstruck_controller_util.flash_bag_param_converter'));
        $this->assertTrue($this->container->has('zenstruck_controller_util.session_param_converter'));
        $this->assertFalse($this->container->has('zenstruck_controller_util.serializer_view_listener'));
        $this->assertFalse($this->container->has('zenstruck_controller_util.convert_exception_listener'));
        $this->assertFalse($this->container->has('zenstruck_controller_util.security_context_converter'));
        $this->assertFalse($this->container->has('zenstruck_controller_util.form_factory_param_converter'));
    }

    public function testJmsSerializerBundle()
    {
        $this->setParameter('kernel.bundles', array('JMSSerializerBundle' => 'JMSSerializerBundle'));
        $this->load();
        $this->compile();

        $this->assertTrue($this->container->has('zenstruck_controller_util.serializer_view_listener'));
    }

    public function testFormFactoryEnabled()
    {
        $this->setParameter('form.factory.class', 'foo');
        $this->load();
        $this->compile();

        $this->assertTrue($this->container->has('zenstruck_controller_util.form_factory_param_converter'));
    }

    public function testSecurityContextEnabled()
    {
        $this->setParameter('security.context.class', 'foo');
        $this->load();
        $this->compile();

        $this->assertTrue($this->container->has('zenstruck_controller_util.security_context_converter'));
    }

    public function testExceptionMapConfig()
    {
        $this->load(array(
                'exception_map' => array(
                    'InvalidArgumentException' => 500,
                ),
            ));
        $this->compile();

        $this->assertTrue($this->container->has('zenstruck_controller_util.convert_exception_listener'));
    }

    /**
     * @expectedException \Symfony\Component\Config\Definition\Exception\InvalidTypeException
     */
    public function testExceptionMapConfigInvalidCode()
    {
        $this->load(array(
                'exception_map' => array(
                    'InvalidArgumentException' => 'foo',
                ),
            ));
        $this->compile();
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Class "Foo\Bar\Baz" does not exist in zenstruck_controller_util.exception_map.
     */
    public function testExceptionMapConfigNonExistentClass()
    {
        $this->load(array(
                'exception_map' => array(
                    'Foo\Bar\Baz' => 500,
                ),
            ));
        $this->compile();
    }

    protected function getContainerExtensions()
    {
        $this->setParameter('kernel.bundles', array());

        return array(new ZenstruckControllerUtilExtension());
    }
}

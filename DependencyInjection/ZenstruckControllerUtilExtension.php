<?php

namespace Zenstruck\ControllerUtilBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

class ZenstruckControllerUtilExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('listeners.xml');
        $loader->load('param_converters/session.xml');
        $loader->load('param_converters/flash_bag.xml');

        if ($container->hasParameter('security.context.class')) {
            $loader->load('param_converters/security_context.xml');
        }

        if ($container->hasParameter('form.factory.class')) {
            $loader->load('param_converters/form_factory.xml');
        }

        $bundles = $container->getParameter('kernel.bundles');

        if (isset($bundles['JMSSerializerBundle'])) {
            $loader->load('serializer_listener.xml');
        }
    }
}

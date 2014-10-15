<?php

namespace Zenstruck\ControllerUtilBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\ConfigurableExtension;
use Symfony\Component\DependencyInjection\Loader;

class ZenstruckControllerUtilExtension extends ConfigurableExtension
{
    /**
     * {@inheritdoc}
     */
    protected function loadInternal(array $mergedConfig, ContainerBuilder $container)
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

        $this->registerConvertExceptionListener($mergedConfig['exception_map'], $loader, $container);
    }

    private function registerConvertExceptionListener(array $exceptionMap, Loader\XmlFileLoader $loader, ContainerBuilder $container)
    {
        if (!count($exceptionMap)) {
            return;
        }

        foreach ($exceptionMap as $class => $statusCode) {
            if (!class_exists($class)) {
                throw new \InvalidArgumentException(
                    sprintf('Class "%s" does not exist in zenstruck_controller_util.exception_map.', $class)
                );
            }
        }

        $loader->load('convert_exception_listener.xml');
        $container->setParameter('zenstruck_controller_util.exception_map', $exceptionMap);
    }
}

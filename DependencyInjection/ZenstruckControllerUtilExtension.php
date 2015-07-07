<?php

namespace Zenstruck\ControllerUtilBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\ConfigurableExtension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

class ZenstruckControllerUtilExtension extends ConfigurableExtension
{
    /**
     * {@inheritdoc}
     */
    protected function loadInternal(array $mergedConfig, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));

        $this->registerDefaultListeners($mergedConfig, $loader);
        $this->registerNoContentViewListener($mergedConfig, $loader, $container);
        $this->registerSerializerViewListener($mergedConfig, $loader, $container);
        $this->registerParamConverterListener($mergedConfig, $loader, $container);
        $this->registerConvertExceptionListener($mergedConfig, $loader, $container);
    }

    private function registerParamConverterListener(array $mergedConfig, XmlFileLoader $loader, ContainerBuilder $container)
    {
        $config = $mergedConfig['param_converter_listener'];

        if (!$config['enabled']) {
            return;
        }

        $loader->load('param_converter_listener.xml');

        if ($config['session']) {
            $loader->load('param_converters/session.xml');
        }

        if ($config['flash_bag']) {
            $loader->load('param_converters/flash_bag.xml');
        }

        if ($config['security_context'] && $container->hasParameter('security.context.class')) {
            $loader->load('param_converters/security_context.xml');
        }

        if ($config['form_factory'] && $container->hasParameter('form.factory.class')) {
            $loader->load('param_converters/form_factory.xml');
        }
    }

    private function registerNoContentViewListener(array $mergedConfig, XmlFileLoader $loader, ContainerBuilder $container)
    {
        if (!$mergedConfig['no_content_view_listener']['enabled']) {
            return;
        }

        $loader->load('no_content_view_listener.xml');
        $container->setParameter('zenstruck_controller_util.no_content_view_listener.allow_null', $mergedConfig['no_content_view_listener']['allow_null']);
    }

    private function registerDefaultListeners(array $mergedConfig, XmlFileLoader $loader)
    {
        foreach (array('forward_listener', 'redirect_listener', 'templating_view_listener', 'has_flashes_listener') as $listener) {
            if (false === $mergedConfig[$listener]) {
                continue;
            }

            $loader->load(sprintf('%s.xml', $listener));
        }
    }

    private function registerSerializerViewListener(array $mergedConfig, XmlFileLoader $loader, ContainerBuilder $container)
    {
        $bundles = $container->getParameter('kernel.bundles');

        if (isset($bundles['JMSSerializerBundle']) && $mergedConfig['serializer_view_listener']) {
            $loader->load('serializer_view_listener.xml');
        }
    }

    private function registerConvertExceptionListener(array $mergedConfig, XmlFileLoader $loader, ContainerBuilder $container)
    {
        $exceptionMap = $mergedConfig['exception_map'];

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

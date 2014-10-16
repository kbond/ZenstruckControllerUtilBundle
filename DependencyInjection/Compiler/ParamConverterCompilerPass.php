<?php

namespace Zenstruck\ControllerUtilBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * @author Kevin Bond <kevinbond@gmail.com>
 */
class ParamConverterCompilerPass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('zenstruck_controller_util.param_converter_listener')) {
            return;
        }

        $definition = $container->getDefinition('zenstruck_controller_util.param_converter_listener');
        $taggedServices = $container->findTaggedServiceIds('zenstruck_controller_util.param_converter');

        foreach ($taggedServices as $id => $attributes) {
            $definition->addMethodCall('addParamConverter', array(new Reference($id)));
        }
    }
}

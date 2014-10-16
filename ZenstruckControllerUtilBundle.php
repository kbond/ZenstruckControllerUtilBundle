<?php

namespace Zenstruck\ControllerUtilBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Zenstruck\ControllerUtilBundle\DependencyInjection\Compiler\ParamConverterCompilerPass;

class ZenstruckControllerUtilBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new ParamConverterCompilerPass());
    }
}

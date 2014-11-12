<?php

namespace Zenstruck\ControllerUtilBundle\Tests\DependencyInjection\Compiler;

use Matthias\SymfonyDependencyInjectionTest\PhpUnit\AbstractCompilerPassTestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;
use Zenstruck\ControllerUtilBundle\DependencyInjection\Compiler\ParamConverterCompilerPass;

/**
 * @author Kevin Bond <kevinbond@gmail.com>
 */
class ParamConverterCompilerPassTest extends AbstractCompilerPassTestCase
{
    public function testProcess()
    {
        $this->setDefinition('zenstruck_controller_util.param_converter_listener', new Definition());

        $converter = new Definition();
        $converter->addTag('zenstruck_controller_util.param_converter');

        $this->setDefinition('my_converter', $converter);

        $this->compile();

        $this->assertContainerBuilderHasServiceDefinitionWithMethodCall(
            'zenstruck_controller_util.param_converter_listener',
            'addParamConverter',
            array(
                new Reference('my_converter'),
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function registerCompilerPass(ContainerBuilder $container)
    {
        $container->addCompilerPass(new ParamConverterCompilerPass());
    }
}

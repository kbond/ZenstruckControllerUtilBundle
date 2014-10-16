<?php

namespace Zenstruck\ControllerUtilBundle\Tests;

use Zenstruck\ControllerUtilBundle\ZenstruckControllerUtilBundle;

/**
 * @author Kevin Bond <kevinbond@gmail.com>
 */
class ZenstruckControllerUtilBundleTest extends \PHPUnit_Framework_TestCase
{
    public function testCompilerPassesAreRegistered()
    {
        $container = $this
            ->getMock('Symfony\Component\DependencyInjection\ContainerBuilder');

        $container
            ->expects($this->atLeastOnce())
            ->method('addCompilerPass')
            ->with($this->isInstanceOf('Symfony\\Component\\DependencyInjection\\Compiler\\CompilerPassInterface'));

        $bundle = new ZenstruckControllerUtilBundle();
        $bundle->build($container);
    }
}

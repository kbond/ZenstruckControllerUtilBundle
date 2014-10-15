<?php

namespace Zenstruck\ControllerUtilBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * @author Kevin Bond <kevinbond@gmail.com>
 */
class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('zenstruck_controller_util');

        $rootNode
            ->children()
                ->arrayNode('exception_map')
                    ->useAttributeAsKey('exception_class')
                    ->prototype('integer')->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}

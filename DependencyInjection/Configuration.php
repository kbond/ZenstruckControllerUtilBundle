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
                ->booleanNode('serializer_view_listener')
                    ->defaultTrue()
                    ->info('When true, only enabled if JMSSerializerBundle is registered.')
                ->end()
                ->booleanNode('forward_listener')->defaultTrue()->end()
                ->booleanNode('redirect_listener')->defaultTrue()->end()
                ->booleanNode('templating_view_listener')->defaultTrue()->end()
                ->booleanNode('has_flashes_listener')->defaultTrue()->end()
                ->arrayNode('no_content_view_listener')
                    ->canBeDisabled()
                    ->children()
                        ->booleanNode('allow_null')
                            ->defaultTrue()
                            ->info('When true, controllers can return just null, otherwise an empty view is required.')
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('param_converter_listener')
                    ->canBeDisabled()
                    ->children()
                        ->booleanNode('session')->defaultTrue()->end()
                        ->booleanNode('flash_bag')->defaultTrue()->end()
                        ->booleanNode('security_context')
                            ->defaultTrue()
                            ->info('When true, only enabled if security is enabled.')
                        ->end()
                        ->booleanNode('form_factory')
                            ->defaultTrue()
                            ->info('When true, only enabled if forms are enabled.')
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('exception_map')
                    ->useAttributeAsKey('exception_class')
                    ->prototype('integer')->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}

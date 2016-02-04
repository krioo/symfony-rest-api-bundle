<?php

namespace MediaMonks\RestApiBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

final class Configuration implements ConfigurationInterface
{
    /**
     * Generates the configuration tree.
     *
     * @return TreeBuilder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('mediamonks_rest_api');

        $rootNode
            ->children()
                ->scalarNode('post_message_origin')
                    ->defaultNull()
                ->end()
                ->arrayNode('path')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->arrayNode('whitelist')
                            ->addDefaultsIfNotSet()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('output_formats')
                    ->defaultValue(['json'])
                    ->validate()
                        ->ifNotInArray(['xml', 'json'])
                        ->thenInvalid('Formats can only contain "json" and "xml"')
                    ->end()
                    ->prototype('scalar')
                ->end()
            ->end();

        return $treeBuilder;
    }
}
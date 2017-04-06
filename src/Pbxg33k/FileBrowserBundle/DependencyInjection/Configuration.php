<?php

namespace Pbxg33k\FileBrowserBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/configuration.html}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('pbxg33k_file_browser');

        $rootNode
            ->children()
                ->scalarNode('mount_manager')->isRequired()->end()
                ->arrayNode('filesystem')
                    ->prototype('scalar')->end()
                ->end()
                ->arrayNode('filters')
                    ->prototype('array')
                        ->children()
                            ->scalarNode('adapter')->end()
                            ->booleanNode('enabled')->defaultFalse()->end()
                            ->arrayNode('options')->prototype('scalar')->end()
                        ->end()
                    ->end()
                ->end()
            ->end();

        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.

        return $treeBuilder;
    }
}

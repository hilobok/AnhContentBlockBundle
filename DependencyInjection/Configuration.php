<?php

namespace Anh\ContentBlockBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('anh_content_block');

        $rootNode
            ->children()
                ->arrayNode('positions')
                    ->defaultValue(array('left', 'right', 'header', 'footer'))
                    ->prototype('scalar')
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
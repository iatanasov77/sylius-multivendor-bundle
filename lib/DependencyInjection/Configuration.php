<?php namespace Vankosoft\SyliusMultiVendor\DependencyInjection;

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
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder    = new TreeBuilder( 'vs_sylius_multivendor' );
        $rootNode       = $treeBuilder->getRootNode();

        $rootNode
            ->children()
                //->booleanNode( 'enabled' )->defaultValue( true )->end()
            ->end()
        ;
        
        return $treeBuilder;
    }
}

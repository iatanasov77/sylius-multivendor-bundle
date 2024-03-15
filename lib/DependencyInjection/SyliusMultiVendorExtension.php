<?php namespace Vankosoft\SyliusMultiVendor\DependencyInjection;

use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class SyliusMultiVendorExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load( array $config, ContainerBuilder $container )
    {
        $config = $this->processConfiguration( $this->getConfiguration([], $container), $config );
        
        $loader = new Loader\YamlFileLoader( $container, new FileLocator( __DIR__ . '/../Resources/config' ) );
        $loader->load( 'services.yaml' );
    }
}

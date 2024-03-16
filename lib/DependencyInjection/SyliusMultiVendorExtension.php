<?php namespace Vankosoft\SyliusMultiVendor\DependencyInjection;

use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Sylius\Bundle\CoreBundle\DependencyInjection\PrependDoctrineMigrationsTrait;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class SyliusMultiVendorExtension extends Extension implements PrependExtensionInterface
{
    use PrependDoctrineMigrationsTrait;
    
    /**
     * {@inheritDoc}
     */
    public function load( array $config, ContainerBuilder $container )
    {
        $config = $this->processConfiguration( $this->getConfiguration([], $container), $config );
        
        $loader = new Loader\YamlFileLoader( $container, new FileLocator( __DIR__ . '/../Resources/config' ) );
        $loader->load( 'services.yaml' );
    }
    
    public function getConfiguration( array $config, ContainerBuilder $container ): ConfigurationInterface
    {
        return new Configuration();
    }
    
    public function prepend( ContainerBuilder $container ): void
    {
        $this->prependDoctrineMigrations($container);
    }
    
    protected function getMigrationsNamespace(): string
    {
        return 'Vankosoft\SyliusMultiVendor\DoctrineMigrations';
    }
    
    protected function getMigrationsDirectory(): string
    {
        return '@SyliusMultiVendorBundle/DoctrineMigrations';
    }
    
    protected function getNamespacesOfMigrationsExecutedBefore(): array
    {
        return [
            'Odiseo\SyliusVendorPlugin\Migrations',
        ];
    }
}

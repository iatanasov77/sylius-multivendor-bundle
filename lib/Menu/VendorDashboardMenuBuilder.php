<?php namespace Vankosoft\SyliusMultiVendor\Menu;

use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Odiseo\SyliusVendorPlugin\Entity\VendorInterface;
use Odiseo\SyliusVendorPlugin\Event\VendorFormMenuBuilderEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Vankosoft\SyliusMultiVendor\Menu\Event\VendorDashboardMenuBuilderEvent;

final class VendorDashboardMenuBuilder
{
    /** @var FactoryInterface */
    private $factory;
    
    /** @var EventDispatcherInterface */
    private $eventDispatcher;
    
    public function __construct(
        FactoryInterface $factory,
        EventDispatcherInterface $eventDispatcher
    ) {
        $this->factory          = $factory;
        $this->eventDispatcher  = $eventDispatcher;
    }
    
    public function createMenu( array $options = [] ): ItemInterface
    {
        $menu = $this->factory->createItem( 'root' );
        
        if ( ! array_key_exists( 'vendor', $options ) || ! $options['vendor'] instanceof VendorInterface ) {
            return $menu;
        }
        
        // Dashboard
        $menu
            ->addChild( 'dashboard' )
            ->setAttribute( 'template', '@SyliusMultiVendor/Pages/Dashboard/Tab/_dashboard.html.twig' )
            ->setLabel( 'sylius.ui.dashboard' )
            ->setCurrent( true )
        ;
        
        // My Vendor Details
        $menu
            ->addChild( 'details' )
            ->setAttribute( 'template', '@SyliusMultiVendor/Pages/Dashboard/Tab/_details.html.twig' )
            ->setLabel( 'sylius.ui.vendor_details' )
            ->setCurrent( true )
        ;
        
        // Orders
        $menu
            ->addChild( 'orders' )
            ->setAttribute( 'template', '@SyliusMultiVendor/Pages/Dashboard/Tab/_orders.html.twig' )
            ->setLabel( 'sylius.ui.orders' )
        ;
        
        // Products
        $menu
            ->addChild( 'products' )
            ->setAttribute( 'template', '@SyliusMultiVendor/Pages/Dashboard/Tab/_products.html.twig' )
            ->setLabel( 'sylius.ui.products' )
        ;
        
        $this->eventDispatcher->dispatch(
            new VendorDashboardMenuBuilderEvent( $this->factory, $menu, $options['vendor'] ),
        );
        
        return $menu;
    }
}
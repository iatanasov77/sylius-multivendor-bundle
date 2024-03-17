<?php namespace Vankosoft\SyliusMultiVendor\Menu\Event;

use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Odiseo\SyliusVendorPlugin\Entity\VendorInterface;
use Sylius\Bundle\UiBundle\Menu\Event\MenuBuilderEvent;

class VendorDashboardMenuBuilderEvent extends MenuBuilderEvent
{
    public function __construct(
        FactoryInterface $factory,
        ItemInterface $menu,
        private VendorInterface $vendor,
    ) {
        parent::__construct( $factory, $menu );
    }
    
    public function getVendor(): VendorInterface
    {
        return $this->vendor;
    }
}
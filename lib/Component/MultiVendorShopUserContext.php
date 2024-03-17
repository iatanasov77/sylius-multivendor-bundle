<?php namespace Vankosoft\SyliusMultiVendor\Component;

class MultiVendorShopUserContext
{
    const TYPE_CUSTOMER     = 'customer';
    const TYPE_VENDOR       = 'vendor';
    
    const CUSTOMER_TYPES    = [
        self::TYPE_CUSTOMER => 'sylius.form.register.customer',
        self::TYPE_VENDOR   => 'sylius.form.register.vendor',
    ];
}
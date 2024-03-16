<?php namespace Vankosoft\SyliusMultiVendor\Component;

class Customer
{
    const TYPE_CUSTOMER     = 'customer';
    const TYPE_VENDOR       = 'vendor';
    
    const CUSTOMER_TYPES    = [
        self::TYPE_CUSTOMER => 'vs_vvp.form.video_platform_settings.video_url_type_symfony_route',
        self::TYPE_VENDOR  => 'vs_vvp.form.video_platform_settings.video_url_type_cloud_public_url',
    ];
}
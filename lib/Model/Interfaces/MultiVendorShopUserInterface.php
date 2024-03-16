<?php namespace Vankosoft\SyliusMultiVendor\Model\Interfaces;

interface MultiVendorShopUserInterface
{
    public function getCustomerType(): string;
    
    public function setCustomerType( string $customerType ): void;
}
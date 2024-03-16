<?php namespace Vankosoft\SyliusMultiVendor\Model\Traits;

use Doctrine\ORM\Mapping as ORM;
use Odiseo\SyliusVendorPlugin\Entity\VendorInterface;

trait MultiVendorShopUserEntity
{
    /**
     * @var string
     * 
     * @ORM\Column(name="customer_type", type="string", columnDefinition="ENUM('customer', 'vendor')", options={"default":"customer"})
     */
    #[ORM\Column(name: "customer_type", type: "string", columnDefinition: "ENUM('customer', 'vendor')", options: ["default" => "customer"])]
    protected $customerType;
    
    /**
     * @var VendorInterface|null
     * 
     * @ORM\OneToOne(targetEntity=VendorInterface::class)
     * @ORM\JoinColumn(name="vendor_id", referencedColumnName="id")
     */
    #[ORM\OneToOne(targetEntity: VendorInterface::class)]
    #[ORM\JoinColumn(name: "vendor_id", referencedColumnName: "id")]
    protected $vendor = null;
    
    public function getCustomerType(): string
    {
        return $this->customerType;
    }
    
    public function setCustomerType( string $customerType ): void
    {
        $this->customerType = $customerType;
    }
    
    public function getVendor(): ?VendorInterface
    {
        return $this->vendor;
    }
    
    public function setVendor( ?VendorInterface $vendor ): void
    {
        $this->vendor = $vendor;
    }
}
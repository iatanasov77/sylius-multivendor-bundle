<?php namespace Vankosoft\SyliusMultiVendor\Form\Extension;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;
use Sylius\Bundle\CoreBundle\Form\Type\Customer\CustomerRegistrationType;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

use Vankosoft\SyliusMultiVendor\Component\Customer;

final class CustomerRegistrationTypeExtension extends AbstractTypeExtension
{
    public function buildForm( FormBuilderInterface $builder, array $options ): void
    {
        $builder
            ->add( 'customerType', ChoiceType::class, [
                'label'     => 'sylius.form.register.customer_type',
                
                'choices'   => \array_flip( Customer::CUSTOMER_TYPES ),
                'data'      => \array_key_first( Customer::CUSTOMER_TYPES ),
                'expanded'  => true,
                
                'mapped'    => false,
                'required'  => false,
            ])
        ;
    }
    
    public static function getExtendedTypes(): iterable
    {
        return [CustomerRegistrationType::class];
    }
}
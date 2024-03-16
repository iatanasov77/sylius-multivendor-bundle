<?php namespace Vankosoft\SyliusMultiVendor\EventListener;

use Symfony\Component\EventDispatcher\GenericEvent;
use Sylius\Component\Channel\Context\ChannelContextInterface;
use Sylius\Component\Core\Model\ChannelInterface;
use Sylius\Component\Core\Model\CustomerInterface;
use Sylius\Component\Core\Model\ShopUserInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Sylius\Component\Product\Generator\SlugGeneratorInterface;
use Doctrine\Persistence\ObjectManager;
use Webmozart\Assert\Assert;

use Vankosoft\SyliusMultiVendor\Component\MultiVendorShopUserContext;

final class UserRegistrationListener
{
    /** @var ObjectManager */
    private $userManager;
    
    /** @var ChannelContextInterface */
    private $channelContext;
    
    /** @var SlugGeneratorInterface */
    private $slugGenerator;
    
    /** @var RepositoryInterface */
    private $vendorsRepository;
    
    /** @var FactoryInterface */
    private $vendorsFactory;
    
    public function __construct(
        ObjectManager $userManager,
        ChannelContextInterface $channelContext,
        SlugGeneratorInterface $slugGenerator,
        RepositoryInterface $vendorsRepository,
        FactoryInterface $vendorsFactory
    ) {
        $this->userManager          = $userManager;
        $this->channelContext       = $channelContext;
        $this->slugGenerator        = $slugGenerator;
        $this->vendorsRepository    = $vendorsRepository;
        $this->vendorsFactory       = $vendorsFactory;
    }
    
    public function handleVendorRegistration( GenericEvent $event ): void
    {
        $customer = $event->getSubject();
        Assert::isInstanceOf( $customer, CustomerInterface::class );
        
//         $user = $customer->getUser();
//         Assert::isInstanceOf( $user, ShopUserInterface::class );
        
        if ( $customer->getCustomerType() == MultiVendorShopUserContext::TYPE_VENDOR ) {
            /** @var ChannelInterface $channel */
            $channel = $this->channelContext->getChannel();
            if ( ! $channel->isAccountVerificationRequired() ) {
                /**
                 * @NOTE i.atanasov77@gmail.com
                 * I'm not sure if this will work
                 */
                $channel->setAccountVerificationRequired( true );
            }
            
            $this->createVendorForUser( $customer, $channel );
        }
    }
    
    private function createVendorForUser( CustomerInterface $customer, ChannelInterface $channel ): void
    {
        $shopName   = \sprintf( '%s Shop', \ucfirst( $customer->getFullName() ) );
        $vendor = $this->vendorsFactory->createNew();
        
        $vendor->setName( $shopName );
        $vendor->setSlug( $this->slugGenerator->generate( $shopName ) );
        $vendor->setEmail( $customer->getEmail() );
        //$vendor->setlogoFile(  );
        
        $vendor->addChannel( $channel );
        $vendor->setEnabled( false );
        
        $this->userManager->persist( $vendor );
        
        $customer->setVendor( $vendor );
        $this->userManager->persist( $customer );
        
        $this->userManager->flush();
    }
}
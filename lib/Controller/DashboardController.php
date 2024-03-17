<?php namespace Vankosoft\SyliusMultiVendor\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Doctrine\Persistence\ManagerRegistry;
use Sylius\Component\Resource\Repository\RepositoryInterface;

class DashboardController extends AbstractController
{
    /** @var ManagerRegistry */
    protected $doctrine;
    
    /** @var RepositoryInterface */
    protected $vendorsRepository;
    
    public function __construct(
        ManagerRegistry $doctrine,
        RepositoryInterface $vendorsRepository
    ) {
        $this->doctrine             = $doctrine;
        $this->vendorsRepository    = $vendorsRepository;
    }
    
    public function index( Request $request ): Response
    {
        $user   = $this->getUser();
        if ( ! $user ) {
            return $this->redirectToRoute( 'sylius_shop_login' );
        }
        
        $vendor = $user->getCustomer()->getVendor();
        if ( ! $vendor ) {
            return $this->redirectToRoute( 'sylius_shop_login' );
        }
        
        return $this->render( '@SyliusMultiVendor/Pages/Dashboard/index.html.twig', [
            'vendor'    => $vendor,
        ]);
    }
}
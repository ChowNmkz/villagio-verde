<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CustomerRepository;

class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'app_profile')]
    public function index(CustomerRepository $customerRepository): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        $idCustomer = $user->getCustomer();

        $customer = $customerRepository->findOneBy(['id' => $idCustomer]);
        
        return $this->render('profile/index.html.twig', [
            'customer' => $customer,
            'user' => $user,
        ]);
    }
    
    #[route('/profile/edit' , name: 'app_profile_edit')]
    public function editCustomer(): Response
    {
        
    }
}

<?php

namespace App\Controller;

use App\Form\CustomerType;


use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function editProfileCustomer(Request $request,CustomerRepository $customerRepository, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();

        $idCustomer = $user->getCustomer();

        $customer = $customerRepository->findOneBy(['id' => $idCustomer]);

        $form = $this->createForm(CustomerType::class, $customer);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $customer = $form->getData();
            $entityManager->persist($customer);
            $entityManager->flush();

            return $this->redirectToRoute('app_home');
        }

        return $this->render('profile/editProfile.html.twig', [
            'form' => $form->createView(),
            'user' => $user,
            'customer' => $customer,
        ]);
    }
}

<?php

namespace App\Controller;

use App\Form\CustomerType;


use App\Repository\EmployeeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CustomerRepository;

class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'app_profile')]
    public function index(CustomerRepository $customerRepository, EmployeeRepository $employeeRepository): Response
    {
        if ($this->isGranted("ROLE_EMPLOYEE")) {
            return $this->render('profile/employee.html.twig', [
                'headerTitle' => 'Ravi de vous revoir',
                'headerDesc' => '',
            ]);
        } else {
            return $this->render('profile/customer.html.twig', [
                'headerTitle' => 'Ravi de vous revoir',
                'headerDesc' => '',
            ]);
        }
    }

    #[route('/profile/edit' , name: 'app_profile_edit')]
    public function editProfileCustomer(Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CustomerType::class, $customer);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $customer = $form->getData();
            $entityManager->persist($customer);
            $entityManager->flush();

            return $this->redirectToRoute('app_home');
        }

        return $this->render('profile/edit_profile.html.twig', [
            'form' => $form->createView(),
            'headerTitle' => 'Modification du profil',
            'headerDesc' => '',
        ]);
    }
}

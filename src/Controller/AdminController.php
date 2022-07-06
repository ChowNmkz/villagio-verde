<?php

namespace App\Controller;

use App\Entity\Employee;
use App\Entity\User;
use App\Form\EmployeeAccountType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(Request $request): Response
    {

        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    #[Route('/admin/add_employee', name: 'app_admin_add_employee')]
    public function addEmployee(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $userPasswordHasher): Response
    {
        $user = new User();
        $employee = new Employee();
        $form = $this->createForm(EmployeeAccountType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user
                ->setEmail($form->get("email")->getData())
                ->setUsername($form->get("username")->getData())
                ->setRoles(['ROLE_EMPLOYEE'])
                ->setIsVerified(1)
                ->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $employee
                ->setFirstname($form->get("firstname")->getData())
                ->setLastname($form->get("lastname")->getData())
                ->setGender($form->get("gender")->getData())
                ->setAddress($form->get("address")->getData())
                ->setZipcode($form->get("zipcode")->getData())
                ->setCity($form->get("city")->getData())
                ->setPost($form->get("post")->getData());

            // associate the new customer entity with the user account
            $user->setEmployee($employee);

            $entityManager->persist($user);
            $entityManager->persist($employee);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin');
        }

        return $this->render('admin/employeeregister.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}


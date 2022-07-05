<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Entity\User;
use App\Factory\CustomerFactory;
use App\Form\CustomerType;
use App\Form\RegistrationFormType;
use App\Repository\UserRepository;
use App\Security\EmailVerifier;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Address;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;

class RegistrationController extends AbstractController
{
    private EmailVerifier $emailVerifier;

    public function __construct(EmailVerifier $emailVerifier)
    {
        $this->emailVerifier = $emailVerifier;
    }

    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager, CustomerFactory $customerFactory): Response
    {
        $user = new User();
        $form = $this->createForm(CustomerType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // set role on USER role
            $user->setRoles(['ROLE_USER']);
            // encode the plain password
            $user->setPassword(
            $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $user
                ->setEmail($form->get("email")->getData())
                ->setUsername($form->get("username")->getData());


            if ($form->get("custType")->getData() === false ){

                // use a customer factory for generate a new customer entity
                $phone = $form->get("phone")->getData();
                $firstName = $form->get("individualFirstname")->getData();
                $lastName = $form->get("individualLastname")->getData();
                $customer = $customerFactory->createIndividualCustomer($phone, $firstName, $lastName);


            } else {
                // use a professional customer factory for generate a new customer entity
                $phone = $form->get("phone")->getData();
                $proBrand = $form->get("professionnalBrand")->getData();
                $proContact = $form->get("professionnalContact")->getData();
                $proSiren = $form->get("professionnalSiren")->getData();
                $customer = $customerFactory->createProfessionalCustomer($phone, $proBrand, $proContact, $proSiren);
            }

            if ($form->get("sameAddress")->getData() === false ){
                $customer
                    ->setDeliveryAddress($form->get("deliveryAddress")->getData())
                    ->setDeliveryZipcode($form->get("deliveryZipcode")->getData())
                    ->setDeliveryCity($form->get("deliveryCity")->getData())
                    ->setBillAddress($form->get("deliveryAddress")->getData())
                    ->setBillZipcode($form->get("deliveryZipcode")->getData())
                    ->setBillCity($form->get("deliveryCity")->getData());
            } else {
                //
            $customer
                ->setDeliveryAddress($form->get("deliveryAddress")->getData())
                ->setDeliveryZipcode($form->get("deliveryZipcode")->getData())
                ->setDeliveryCity($form->get("deliveryCity")->getData())
                ->setBillAddress($form->get("billAddress")->getData())
                ->setBillZipcode($form->get("billZipcode")->getData())
                ->setBillCity($form->get("billCity")->getData());
            }

            // associate the new customer entity with the user account
            $user->setCustomer($customer);

            $entityManager->persist($user);
            $entityManager->persist($customer);
            $entityManager->flush();

            // generate a signed url and email it to the user
            $this->emailVerifier->sendEmailConfirmation('app_verify_email', $user,
                (new TemplatedEmail())
                    ->from(new Address('no_reply@villagioverde.com', 'Villagio Verde'))
                    ->to($user->getEmail())
                    ->subject('Confirmer votre E-Mail, s\'il-vous-plaît')
                    ->htmlTemplate('registration/confirmation_email.html.twig')
            );

            // do anything else you need here, like send an email
            return $this->redirectToRoute('app_home');
        }


        return $this->render('registration/register.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/verify/email', name: 'app_verify_email')]
    public function verifyUserEmail(Request $request, TranslatorInterface $translator, UserRepository $userRepository): Response
    {
        $id = $request->get('id');

        if (null === $id) {
            return $this->redirectToRoute('app_register');
        }

        $user = $userRepository->find($id);

        if (null === $user) {
            return $this->redirectToRoute('app_register');
        }

        // validate email confirmation link, sets User::isVerified=true and persists
        try {
            $this->emailVerifier->handleEmailConfirmation($request, $user);
        } catch (VerifyEmailExceptionInterface $exception) {
            $this->addFlash('verify_email_error', $translator->trans($exception->getReason(), [], 'VerifyEmailBundle'));

            return $this->redirectToRoute('app_home');
        }

        // @TODO Change the redirect on success and handle or remove the flash message in your templates
        $this->addFlash('success', 'Ton E-Mail a bien été verifié.');

        return $this->redirectToRoute('app_home');
    }
}

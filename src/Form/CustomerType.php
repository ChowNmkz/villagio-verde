<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class CustomerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('phone')
            ->add('deliveryAddress')
            ->add('deliveryZipcode')
            ->add('deliveryCity')
            ->add('billAddress', TextType::class, [ 'required' => false ])
            ->add('billZipcode', TextType::class, [ 'required' => false ])
            ->add('billCity', TextType::class, [ 'required' => false ])
            ->add('individualLastname', TextType::class, [ 'required' => false ])
            ->add('individualFirstname', TextType::class, [ 'required' => false ])
            ->add('professionnalContact', TextType::class, [ 'required' => false ])
            ->add('professionnalBrand', TextType::class, [ 'required' => false ])
            ->add('professionnalSiren', TextType::class, [ 'required' => false ])
            ->add('sameAddress', CheckboxType::class, [
                'label'    => 'L\'adresse de facturation est la même que l\'adresse de livraison ?',
                'required' => false,
                "mapped" => false
            ])
            ->add('custType', CheckboxType::class, [
                'label'    => 'Vous êtes un client professionnel ?',
                'required' => false,
                "mapped" => false
            ])
            ->add('email')
            ->add('username')
            ->add('agreeTerms', CheckboxType::class, [
                'label' => 'Vous acceptez les régles d\'utilisation',
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Acceptez les termes',
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'label' => 'Mot de passe',
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre mot de passe doit faire {{ limit }} caractères minimum',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // 'data_class' => Customer::class,
        ]);
    }
}

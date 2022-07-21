<?php

namespace App\Form;

use App\Entity\Customer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CustomerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('phone')
            ->add('deliveryAddress')
            ->add('deliveryZipcode')
            ->add('deliveryCity')
            ->add('billAddress')
            ->add('billZipcode')
            ->add('billCity')
            ->add('individualLastname')
            ->add('individualFirstname')
            ->add('professionnalContact')
            ->add('professionnalBrand')
            ->add('professionnalSiren')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Customer::class,
        ]);
    }
}

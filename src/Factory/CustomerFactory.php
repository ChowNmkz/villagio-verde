<?php

namespace App\Factory;

use App\Entity\Customer;


/**
 * Class CustomerFactory
 * @package App\Factory
 */
class CustomerFactory
{
    /**
     * Creates a customer.
     *
     * @param string $phone Set the number phone in the customer entity
     * @param string $firstName Set the first name in the customer entity
     * @param string $lastName Set the last name in the customer entity
     *
     * @return Customer
     */
    public function createIndividualCustomer(string $phone, string $firstName, string $lastName): Customer
    {
        $customer = new Customer();

        $customer
            ->setPhone($phone)
            ->setIndividualFirstname($firstName)
            ->setIndividualLastname($lastName)
            ->setCoeff(1,2);

        return $customer;
    }

    /**
     * Creates a professional customer.
     *
     * @param string $phone Set a number phone for professional contact
     * @param string $proBrand Set the name of brand
     * @param string $proContact Set the name of the contact
     * @param string $proSiren Set the SIREN number
     *
     * @return Customer
     */
    public function createProfessionalCustomer(string $phone, string $proBrand, string $proContact, string $proSiren):Customer
    {
        $customer = new customer();

        $customer
            ->setPhone($phone)
            ->setProfessionnalBrand($proBrand)
            ->setProfessionnalContact($proContact)
            ->setProfessionnalSiren($proSiren)
            ->setCoeff(0,8);

        return $customer;
    }
}
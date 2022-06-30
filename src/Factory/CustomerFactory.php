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
      * @return Customer
      */
    public function createCustomer(): Customer
    {
        $customer = new Customer();
        $customer->setCoeff(0);
        $customer->setEmployee(null);
        $customer->setCreatedAt(new \DateTimeImmutable());
        $customer->setUpdatedAt(new \DateTime());

        return $customer;
    }
}
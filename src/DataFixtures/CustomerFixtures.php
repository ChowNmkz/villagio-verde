<?php

namespace App\DataFixtures;

use App\Entity\Customer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CustomerFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $count = 0;

        if (($fp = fopen(dirname(__FILE__) . '/fixturesCsv/customers.csv', 'r')) !== FALSE) {
            while (($data = fgetcsv($fp, 1000, ",")) !== FALSE) {
                $count += 1;
                $nbFields = count($data);
                $customer = new Customer();
                for ($c = 0; $c < $nbFields; $c++) {
                    $customer->setPhone($data[0]);
                    $customer->setDeliveryAddress($data[1]);
                    $customer->setDeliveryZipcode($data[2]);
                    $customer->setDeliveryCity($data[3]);
                    $customer->setBillAddress($data[4]);
                    $customer->setBillZipcode($data[5]);
                    $customer->setBillCity($data[6]);
                    $customer->setCoeff($data[7]);
                    $customer->setIndividualLastname($data[8]);
                    $customer->setIndividualFirstname($data[9]);
                    $customer->setProfessionnalContact($data[10]);
                    $customer->setProfessionnalBrand($data[11]);
                    $customer->setProfessionnalSiren($data[12]);
                }
                $manager->persist($customer);
                $manager->flush();
            }
        }
    }
}
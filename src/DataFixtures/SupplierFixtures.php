<?php

namespace App\DataFixtures;

use App\Entity\Supplier;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class SupplierFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $count = 0;

        if (($fp = fopen(dirname(__FILE__) . '/fixturesCsv/supplier.csv', 'r')) !== FALSE) {
            while (($data = fgetcsv($fp, 1000, ",")) !== FALSE) {
                $count += 1;
                $nbFields = count($data);
                $supplier = new Supplier();
                for ($c = 0; $c < $nbFields; $c++) {
                    $supplier->setName($data[0]);
                    $supplier->setType($data[1]);
                    $supplier->setEmail($data[2]);
                }
                $manager->persist($supplier);
                $manager->flush();
            }
        }
    }
}

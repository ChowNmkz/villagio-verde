<?php

namespace App\DataFixtures;

use App\Entity\Employee;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EmployeeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $count = 0;

        if (($fp = fopen(dirname(__FILE__) . '/fixturesCsv/employee.csv', 'r')) !== FALSE) {
            while (($data = fgetcsv($fp, 1000, ",")) !== FALSE) {
                $count += 1;
                $nbFields = count($data);
                $employee = new Employee();
                for ($c = 0; $c < $nbFields; $c++) {
                    $employee->setLastname($data[0]);
                    $employee->setFirstname($data[1]);
                    $employee->setGender($data[2]);
                    $employee->setAddress($data[3]);
                    $employee->setZipcode($data[4]);
                    $employee->setCity($data[5]);
                    $employee->setPost($data[6]);
                }
                $manager->persist($employee);
                $manager->flush();
            }
        }
    }
}

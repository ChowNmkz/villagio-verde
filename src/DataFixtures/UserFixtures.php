<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class UserFixtures extends Fixture
{
    public function __construct( private UserPasswordHasherInterface $_hasher) {
    }
    public function load(ObjectManager $manager): void
    {
        $count = 0;

        if (($fp = fopen(dirname(__FILE__) . '/fixturesCsv/users.csv', 'r')) !== FALSE) {
            while (($data = fgetcsv($fp, 1000, ",")) !== FALSE) {
                $count += 1;
                $nbFields = count($data);
                $user = new User();
                for ($c = 0; $c < $nbFields; $c++) {
                    $user->setEmail($data[0]);
                    $user->setUsername($data[1]);
                    //$user->setPassword($data[2]);
                        $plainTextPassword = $data[2];
                        $hashedPassword = $this->_hasher->hashPassword(
                            $user,
                            $plainTextPassword
                        );
                    $user->setPassword($hashedPassword);
                    $user->setRoles([$data[3]]);
                    $manager->persist($user);
                }
                $manager->flush();
            }
        }
    }
}


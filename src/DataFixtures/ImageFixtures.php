<?php

namespace App\DataFixtures;

use App\Entity\Image;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ImageFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $count = 0;

        if (($fp = fopen(dirname(__FILE__) . '/fixturesCsv/images.csv', 'r')) !== FALSE) {
            while (($data = fgetcsv($fp, 1000, ",")) !== FALSE) {
                $count += 1;
                $nbFields = count($data);
                $image = new Image();
                for ($c = 0; $c < $nbFields; $c++) {
                    $image->setSource($data[0]);
                    $image->setDescription('Lorem Ipsum ' .$data[0]. ' Vivalis');
                }
                $manager->persist($image);
                $manager->flush();
            }
        }
    }
}

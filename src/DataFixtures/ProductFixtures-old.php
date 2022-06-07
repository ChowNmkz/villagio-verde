<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $count = 0;

        if (($fp = fopen(dirname(__FILE__) . '/fixturesCsv/product.csv', 'r')) !== FALSE) {
            while (($data = fgetcsv($fp, 1000, ",")) !== FALSE) {
                $count += 1;
                $nbFields = count($data);
                $product = new Product();
                for ($c = 0; $c < $nbFields; $c++) {
                    $product->setName($data[0]);
                    $product->setBuyPrice($data[4]);
                    $product->setStock($data[3]);
                    $product->setDescription($data[1]);
                    $product->setPublish($data[2]);
                    $product->setSellPrice($data[5]);
                }
                $manager->persist($product);
                $manager->flush();
            }
        }
    }
}

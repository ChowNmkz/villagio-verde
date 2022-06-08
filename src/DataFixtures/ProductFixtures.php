<?php

namespace App\DataFixtures;

use App\Entity\Image;
use App\Entity\Product;
use App\DataFixtures\CategoryFixtures;
use App\Repository\CategoryRepository;
use App\Repository\ImageRepository;
use App\Repository\SupplierRepository;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class ProductFixtures extends Fixture implements DependentFixtureInterface
{

  public function __construct( 
    private CategoryRepository $_categoryRepository,
    private SupplierRepository $_supplierRepository,
    private ImageRepository $_imageRepository
  ) {
    }

    public function load(ObjectManager $manager): void
    {

        $count = 0;
        $_suppliers = $this->_supplierRepository->findAll();
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

                    // On gére notre relation avec Image ici
                    $image = new Image();
                    $productName = $product->getName();

                    switch ($productName) {
                        case "Fender - Windy":
                            //guitare electrique
                            $cat = $this->_categoryRepository->findOneByName("Guitares électriques");
                            $product->setCategory($cat);
                            
                            $image = $this->_imageRepository->findByTitleImage('gibson');
                            foreach ($image as $addImg) {
                                $product->addImage($addImg);
                            }
                            break;

                        case "Epiphone - Misti":
                            //guitare electrique
                            $cat = $this->_categoryRepository->findOneByName("Guitares électriques");
                            $product->setCategory($cat);

                            $image = $this->_imageRepository->findByTitleImage('lespaul01');
                            foreach ($image as $addImg) {
                                $product->addImage($addImg);
                            }
                            break;

                        case "Harley - Magdalene":
                            //guitare electrique
                            $cat = $this->_categoryRepository->findOneByName("Guitares électriques");
                            $product->setCategory($cat);

                            $image = $this->_imageRepository->findByTitleImage('strat');
                            foreach ($image as $addImg) {
                                $product->addImage($addImg);
                            }
                            break;

                        case "Akai - Kinna":
                            // clavier numerique
                            $cat = $this->_categoryRepository->findOneByName("Claviers numériques");
                            $product->setCategory($cat);

                            $image = $this->_imageRepository->findByTitleImage('clavier2-');
                            foreach ($image as $addImg) {
                                $product->addImage($addImg);
                            }
                            break;

                        case "Roland - Frederique":
                            // clavier numerique
                            $cat = $this->_categoryRepository->findOneByName("Claviers numériques");
                            $product->setCategory($cat);

                            $image = $this->_imageRepository->findByTitleImage('kai');
                            foreach ($image as $addImg) {
                                $product->addImage($addImg);
                            }
                            break;

                        case "Roland - Shayne":
                            // clavier numerique
                            $cat = $this->_categoryRepository->findOneByName("Claviers numériques");
                            $product->setCategory($cat);

                            $image = $this->_imageRepository->findByTitleImage('clavier-');
                            foreach ($image as $addImg) {
                                $product->addImage($addImg);
                            }
                            break;

                        case "Millenium - Viva":
                            $cat = $this->_categoryRepository->findOneByName("Batteries acoustiques");
                            $product->setCategory($cat);

                            $image = $this->_imageRepository->findByTitleImage('pearl');
                            foreach ($image as $addImg) {
                                $product->addImage($addImg);
                            }
                            break;

                        case "Roland - Gussy":
                            //guitare electrique
                            $cat = $this->_categoryRepository->findOneByName("Guitares électriques");
                            $product->setCategory($cat);
                            
                            $image = $this->_imageRepository->findByTitleImage('telecaster');
                            foreach ($image as $addImg) {
                                $product->addImage($addImg);
                            }
                            break;

                        case "Selmer - Helsa":
                            $cat = $this->_categoryRepository->findOneByName("flutes");
                            $product->setCategory($cat);

                            $image = $this->_imageRepository->findByTitleImage('saxo');
                            foreach ($image as $addImg) {
                                $product->addImage($addImg);
                            }
                            break;

                        case "Küng - Gussy":
                            $cat = $this->_categoryRepository->findOneByName("Flûtes");
                            $product->setCategory($cat);

                            $image = $this->_imageRepository->findByTitleImage('flute');
                            foreach ($image as $addImg) {
                                $product->addImage($addImg);
                            }
                            break;

                        case "Fidelius - Jeanna":
                            $cat = $this->_categoryRepository->findOneByName("violons");
                            $product->setCategory($cat);

                            $image = $this->_imageRepository->findByTitleImage('Violons');
                            foreach ($image as $addImg) {
                                $product->addImage($addImg);
                            }
                            break;
                        case "Akai - Kai":
                            $cat = $this->_categoryRepository->findOneByName("Violons");
                            $product->setCategory($cat);

                            $image = $this->_imageRepository->findByTitleImage('mille');
                            foreach ($image as $addImg) {
                                $product->addImage($addImg);
                            }
                            break;
                    }

                    $product->setSupplier($_suppliers[rand(0, count($_suppliers)-1)]);

                }
                $manager->persist($product);
                $manager->flush();
            }
        }
    }
    public function getDependencies() {
      return  [
        CategoryFixtures::class,
        ImageFixtures::class
      ];
    }
      
}

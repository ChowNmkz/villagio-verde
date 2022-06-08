<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

/* class CategoryFixtures extends Fixture implements DependentFixtureInterface */
class CategoryFixtures extends Fixture
{
  public function load(ObjectManager $manager): void
  {



    $parentCategories = [ 

      1 => [ 'nom' => "Guitares et Basses",
             'image' => "catP_GuitareBasse.jpg",
             'category' => [

                1 => [ 'nom' =>  "Guitares classiques",
                       'image' => "cat_guitare_classic.jpg",
                ],
                2 => [ 'nom' => "Guitares électriques",
                       'image' => "cat_guitare_electrique.jpg",
                ],

             ]
      ],
      2 => [ 'nom' => "Batterie et Percussions",
             'image' => "catP_BatteriePercu.jpg",
             'category' => [
              
                1 => [ 'nom' => "Batteries acoustiques",
                       'image' => "cat_batterie_accoustique.jpg",
                ],
                2 => [ 'nom' => "Batteries électroniques",
                       'image' => "cat_batterie_electronique.jpg",
                ],
             ]
      ],
      3 => [ 'nom' => "Claviers et Pianos",
             'image' => "catP_ClavierPiano.jpg",
             'category' => [

                1 => [ 'nom' => "Claviers acoustiques",
                       'image' => "cat_clavier_arrangeur.jpg",
                ],

                2 => [ 'nom' => "Claviers numériques",
                       'image' => "cat_clavier_numerique.jpg",
                ],
             ]
      ],

      4 => [ 'nom' => "Instruments à vent",
             'image' =>  "catP_InstrumentsVent.jpg",
             'category' => [

                1 => [ 'nom' => "Flûtes",
                       'image' => "cat_flute.jpg",
                ],
             ]
      ],

      5 => [ 'nom' => "Instruments à cordes",
             'image' => "catP_AutresInstruCordes.jpg",
             'category' => [

                1 => [ 'nom' => "Violons",
                       'image' => "cat_violon.jpg",
                ]
             ]
      ]
    ];

    //on crée les categories
    foreach( $parentCategories as $keyParentCategory => $parentCategory ) {
        $newParentCategory = new Category();
        $newParentCategory->setName($parentCategory['nom']);
        $newParentCategory->setDescription($parentCategory['nom']);
        $newParentCategory->setImage($parentCategory['image']);
        $manager->persist($newParentCategory); 

        foreach($parentCategory['category'] as $keySubCategory => $SubCategory ){
          $newSubCategory = new Category(); 
          $newSubCategory-> setName($SubCategory['nom']);
          $newSubCategory-> setDescription($SubCategory['nom']);
          $newSubCategory-> setImage($SubCategory['image']);
          $newSubCategory-> setCatParent($newParentCategory);
          $manager->persist($newSubCategory);
        }
    }
    $manager->flush();
    
  }
    /* public function getDependencies() */
    /* { */
    /*   return []; */
    /* } */
}


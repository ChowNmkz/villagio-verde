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

      1 => [ 'nom' => "Guitare et basses",
             'image' => "catP_GuitareBasse.jpg",
             'category' => [

                1 => [ 'nom' =>  "Guitare classique",
                       'image' => "cat_guitare_classic.jpg",
                ],
                2 => [ 'nom' => "Guitare electrique",
                       'image' => "cat_guitare_electrique.jpg",
                ],

             ]
      ],
      2 => [ 'nom' => "Batteries et percu",
             'image' => "catP_BatteriePercu.jpg",
             'category' => [
              
                1 => [ 'nom' => "batterie accoustique",
                       'image' => "cat_batterie_accoustique.jpg",
                ],
                2 => [ 'nom' => "batterie electrique",
                       'image' => "cat_batterie_electronique.jpg",
                ],
             ]
      ],
      3 => [ 'nom' => "Clavier et piano",
             'image' => "catP_ClavierPiano.jpg",
             'category' => [

                1 => [ 'nom' => "clavier accoustique",
                       'image' => "cat_clavier_arrangeur.jpg",
                ],

                2 => [ 'nom' => "clavier numerique",
                       'image' => "cat_clavier_numerique.jpg",
                ],
             ]
      ],

      4 => [ 'nom' => "Instruments a vent",
             'image' =>  "catP_InstrumentsVent.jpg",
             'category' => [

                1 => [ 'nom' => "flutes",
                       'image' => "cat_flute.jpg",
                ],
             ]
      ],

      5 => [ 'nom' => "Instruments a cordes",
             'image' => "catP_AutresInstruCordes.jpg",
             'category' => [

                1 => [ 'nom' => "violons",
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


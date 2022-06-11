<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Product;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(CategoryRepository $categoryRepository): Response
    {
        $categorie = $categoryRepository->findBy(['catParent' => null ] );
        return $this->render('home/index.html.twig', [
            'categorie' => $categorie,
        ]);
    }

    #[Route('/categorie/{id}', name: 'app_home_category')]
    public function categorieDetails(Category $id): Response
    {
        return $this->render('home/subcat.html.twig', [
            'subcat' => $id,
        ]);
    }

    #[Route('/categorie/produit/{id}', name: 'app_home_product')]
    public function productFromCategory(Category $id, ProductRepository $productRepository): Response
    {
        $product = $productRepository->findBy(['category' => $id ]);
        return $this->render('home/productCat.html.twig', [
            'product' => $product,
        ]);
    }
}


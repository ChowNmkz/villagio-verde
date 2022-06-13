<?php

namespace App\Controller;

use App\Entity\Category;
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
        $category = $categoryRepository->findBy(['catParent' => null ] );
        return $this->render('home/index.html.twig', [
            'category' => $category,
        ]);
    }

    #[Route('/category/{id}', name: 'app_home_category')]
    public function categoryDetail(Category $category): Response
    {
        return $this->render('home/index.html.twig', [
            'category' => $category,
        ]);
    }

   #[Route('/productbycat/{id}', name: 'app_home_productByCategory')]
    public function productList(Category $category, ProductRepository $productRepository): Response
    {
        $product = $productRepository->findBy(['category' => $category]);
        return $this->render('home/product_list.html.twig', [
            'products' => $product,
        ]);
    }
}


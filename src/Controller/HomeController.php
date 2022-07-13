<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use App\Repository\ImageRepository;
use App\Repository\ProductRepository;
use App\Storage\CartSessionStorage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(ProductRepository $productRepository, ImageRepository $imageRepository, CategoryRepository $categoryRepository): Response
    {
        $products = $productRepository->findLastProducts();
        $category = $categoryRepository->findBy(['catParent' => null ] );

        return $this->render('home/index.html.twig', [
            'headerTitle' => 'Bienvenue !',
            'headerDesc' => '',
            'products' => $products,
        ]);
    }

    #[Route('/category', name: 'app_category')]
    public function category(CategoryRepository $categoryRepository): Response
    {
        $category = $categoryRepository->findBy(['catParent' => null ] );

        return $this->render('home/category.html.twig', [
            'category' => $category,
            'headerTitle' => 'Bienvenue !',
            'headerDesc' => '',
        ]);
    }

    #[Route('/category/{id}', name: 'app_home_categoryByCategory')]
    public function categoryDetail(Category $category): Response
    {
        return $this->render('home/category.html.twig', [
            'category' => $category,
            'headerTitle' => $category->getName(),
            'headerDesc' => $category->getDescription(),
        ]);
    }

   #[Route('/productbycat/{id}', name: 'app_home_productByCategory')]
    public function productList(Category $category, ProductRepository $productRepository): Response
    {
        $product = $productRepository->findBy(['category' => $category]);
        return $this->render('home/product_list.html.twig', [
            'products' => $product,
            'headerTitle' => $category->getName(),
            'headerDesc' => $category->getDescription(),
        ]);
    }
}


<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryNavbarController extends AbstractController
{

    public function menuMain(CategoryRepository $categoryRepository): Response
    {
        $category = $categoryRepository->findBy(['catParent' => null ] );

        return $this->render('partials/_catNavbar.html.twig', [
            'category' => $category,
        ]);
    }
}

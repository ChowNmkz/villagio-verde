<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
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
    public function categorie(CategoryRepository $categoryRepository, $id): Response
    {

    }
}


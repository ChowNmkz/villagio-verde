<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/manage/product')]
class ProductManagementController extends AbstractController
{
    #[Route('/', name: 'app_product_management_index', methods: ['GET'])]
    public function index(ProductRepository $productRepository): Response
    {
        return $this->render('product_management/index.html.twig', [
            'products' => $productRepository->findAll(),
            'headerTitle' => 'Liste des produits',
            'headerDesc' => '',
        ]);
    }

    #[Route('/new', name: 'app_product_management_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ProductRepository $productRepository): Response
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $productRepository->add($product, true);

            return $this->redirectToRoute('app_product_management_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('product_management/new.html.twig', [
            'product' => $product,
            'form' => $form,
            'headerTitle' => 'Ajout d\'un nouveau produit',
            'headerDesc' => 'Formulaire d\'ajout d\'un nouveau produit',
        ]);
    }

    #[Route('/{id}', name: 'app_product_management_show', methods: ['GET'])]
    public function show(Product $product): Response
    {
        return $this->render('product_management/show.html.twig', [
            'product' => $product,
            'headerTitle' => 'Détail du produit',
            'headerDesc' => $product->getName(),
        ]);
    }

    #[Route('/{id}/edit', name: 'app_product_management_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Product $product, ProductRepository $productRepository): Response
    {
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $product->setUpdatedAt(new \DateTime());
            $productRepository->add($product, true);

            return $this->redirectToRoute('app_product_management_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('product_management/edit.html.twig', [
            'product' => $product,
            'form' => $form,
            'headerTitle' => 'Edition du produit',
            'headerDesc' => $product->getName(),
        ]);
    }

    #[Route('/{id}', name: 'app_product_management_delete', methods: ['POST'])]
    public function delete(Request $request, Product $product, ProductRepository $productRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$product->getId(), $request->request->get('_token'))) {
            $productRepository->remove($product, true);
        }

        return $this->redirectToRoute('app_product_management_index', [], Response::HTTP_SEE_OTHER);
    }
}

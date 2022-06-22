<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\AddToCartType;
use App\Manager\CartManager;
use App\Factory\CommandFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/product/{id}', name: 'app_product_detail')]
    public function detail(Product $product, Request $request, CartManager $cartManager, CommandFactory $cartFactory): Response
    {
        $form = $this->createForm(AddToCartType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $item = $cartFactory->createDetail($product);
            $test = $form->getData();
            $test2 = $test->getQuantity();
            $item->setQuantity($test2);
            $cart = $cartManager->getCurrentCart();

            $cart
                ->addDetail($item)
                ->setUpdatedAt(new \DateTime());


            $cartManager->save($cart);

            return $this->redirectToRoute('app_product_detail', ['id' => $product->getId()]);
        }

        return $this->render('product/detail.html.twig', [
            'product' => $product,
            'form' => $form->createView()
        ]);
    }
}

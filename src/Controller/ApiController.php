<?php

namespace App\Controller;

use App\Entity\Image;
use App\Entity\Product;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use App\Repository\SupplierRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    #[Route('/api_old/read', name: 'app_api_old_read', methods: ['get'])]
    public function apiRead(ProductRepository $productRepository): Response
    {
        $exportJson = $productRepository->findAll();

        return $this->json($exportJson, 200, [], ["groups" => "read:product"]);
    }

    #[Route('/api_old/add', name: 'app_api_old_add', methods: ['post'])]
    public function apiAdd(Request $request, EntityManagerInterface $entityManager, CategoryRepository $categoryRepository, SupplierRepository $supplierRepository): Response
    {
        $entry = json_decode($request->getContent());

        $name = $entry->name;
        $description = $entry->description;
        $buyPrice = $entry->buyPrice;
        $sellPrice = $entry->sellPrice;
        $stock = $entry->stock;
        $category = $entry->category->id;
        $supplier = $entry->supplier->id;
        $images = $entry->images;

        $product = new Product();
            $product->setName($name);
            $product->setDescription($description);
            $product->setBuyPrice($buyPrice);
            $product->setSellPrice($sellPrice);
            $product->setStock($stock);
            $product->setCreatedAt(new \DateTimeImmutable());
            $product->setUpdatedAt(new \DateTime());
            $product->setPublish(false);

        $cat = $categoryRepository->findOneBy(['id' => $category]);
        $supp = $supplierRepository->findOneBy(['id' => $supplier]);

        $product->setCategory($cat);
        $product->setSupplier($supp);

        foreach ($images as $pic ){
            $imageSource = $pic->source;
            $imageDesc = $pic->description;

            $image = new Image();
                $image->setDescription($imageDesc);
                $image->setSource($imageSource);
                $image->setProduct($product);

                $entityManager->persist($image);
        }

        $entityManager->persist($product);
        $entityManager->flush();

        return $this->json($product, 200, [], ["groups" => "read:product"]);
    }
}
// exemple json object to adding road

/*{
    "name": "Flute - Alpha",
"buyPrice": "354.00",
"stock": 1,
"description": "Une flûte un peu naze.",
"sellPrice": "500.00",
"images": [
{
    "source": "aplha_front.jpg",
"description": "Lorem Ipsum alpha_front.jpg Vivalis"
},
{
    "source": "alpha_back.jpg",
"description": "Lorem Ipsum alha_back.jpg Vivalis"
},
{
    "source": "aplha_zoom.jpg",
"description": "Lorem Ipsum alpha_zoom.jpg Vivalis"
}
],
"category": {
    "id": 11
},
"supplier": {
    "id": 4
}
}*/
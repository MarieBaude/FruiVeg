<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/product', name: 'app_product')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/ProductController.php',
        ]);
    }

    #[Route('/product', name: 'product_create', methods: 'POST')]
    public function create(Request $request): Response
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->submit(json_decode($request->getContent(), true));

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($product);
            $entityManager->flush();

            return $this->json($product);
        }

        return $this->json($form->getErrors(true), 400);
    }

    
    #[Route('/products/{id}', name: 'product_show', methods: 'GET')]
    public function show(Product $product): Response
    {
        return $this->json($product);
    }

    
    #[Route('/products/{id}', name: 'product_update', methods: 'PUT')]
    public function update(Request $request, Product $product): Response
    {
        $form = $this->createForm(ProductType::class, $product);
        $form->submit(json_decode($request->getContent(), true), false);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            return $this->json($product);
        }

        return $this->json($form->getErrors(true), 400);
    }
}

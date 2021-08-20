<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProductRepository;

class ShopController extends AbstractController
{
    /**
     * @Route("/tienda", name="tienda.index")
     */
    public function index(ProductRepository $productRepository): Response
    {

        $products = $productRepository->findAll();
        return $this->render('Shop/index.html.twig',[
            'message'=>'Estas en el INDEX de la tienda',
            'products'=>$products
        ]);
    }



}

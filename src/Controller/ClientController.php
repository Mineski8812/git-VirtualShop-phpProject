<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClientController extends AbstractController
{
    /**
     * @Route("/cliente", name="cliente.index")
     */
    public function index(): Response
    {
        return $this->render('client/index.html.twig', [
            'message' => 'Estas en el INDEX de cliente',
        ]);
    }
}

<?php

namespace App\Controller;

use App\Entity\ShopClient;
use App\Form\ShopClientType;
use App\Repository\ShopClientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/shop/client")
 */
class ShopClientController extends AbstractController
{
    /**
     * @Route("/", name="shop_client_index", methods={"GET"})
     */
    public function index(ShopClientRepository $shopClientRepository): Response
    {
        return $this->render('shop_client/index.html.twig', [
            'shop_clients' => $shopClientRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="shop_client_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $shopClient = new ShopClient();
        $form = $this->createForm(ShopClientType::class, $shopClient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($shopClient);
            $entityManager->flush();

            return $this->redirectToRoute('shop_client_index');
        }

        return $this->render('shop_client/new.html.twig', [
            'shop_client' => $shopClient,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="shop_client_show", methods={"GET"})
     */
    public function show(ShopClient $shopClient): Response
    {
        return $this->render('shop_client/show.html.twig', [
            'shop_client' => $shopClient,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="shop_client_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ShopClient $shopClient): Response
    {
        $form = $this->createForm(ShopClientType::class, $shopClient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('shop_client_index');
        }

        return $this->render('shop_client/edit.html.twig', [
            'shop_client' => $shopClient,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="shop_client_delete", methods={"DELETE"})
     */
    public function delete(Request $request, ShopClient $shopClient): Response
    {
        if ($this->isCsrfTokenValid('delete'.$shopClient->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($shopClient);
            $entityManager->flush();
        }

        return $this->redirectToRoute('shop_client_index');
    }
}

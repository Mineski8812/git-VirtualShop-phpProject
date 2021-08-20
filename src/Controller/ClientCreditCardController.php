<?php

namespace App\Controller;

use App\Entity\ClientCreditCard;
use App\Form\ClientCreditCardType;
use App\Repository\ClientCreditCardRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/client/credit/card")
 */
class ClientCreditCardController extends AbstractController
{
    /**
     * @Route("/", name="client_credit_card_index", methods={"GET"})
     */
    public function index(ClientCreditCardRepository $clientCreditCardRepository): Response
    {
        return $this->render('client_credit_card/index.html.twig', [
            'client_credit_cards' => $clientCreditCardRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="client_credit_card_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $clientCreditCard = new ClientCreditCard();
        $form = $this->createForm(ClientCreditCardType::class, $clientCreditCard);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($clientCreditCard);
            $entityManager->flush();

            return $this->redirectToRoute('client_credit_card_index');
        }

        return $this->render('client_credit_card/new.html.twig', [
            'client_credit_card' => $clientCreditCard,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="client_credit_card_show", methods={"GET"})
     */
    public function show(ClientCreditCard $clientCreditCard): Response
    {
        return $this->render('client_credit_card/show.html.twig', [
            'client_credit_card' => $clientCreditCard,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="client_credit_card_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ClientCreditCard $clientCreditCard): Response
    {
        $form = $this->createForm(ClientCreditCardType::class, $clientCreditCard);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('client_credit_card_index');
        }

        return $this->render('client_credit_card/edit.html.twig', [
            'client_credit_card' => $clientCreditCard,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="client_credit_card_delete", methods={"DELETE"})
     */
    public function delete(Request $request, ClientCreditCard $clientCreditCard): Response
    {
        if ($this->isCsrfTokenValid('delete'.$clientCreditCard->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($clientCreditCard);
            $entityManager->flush();
        }

        return $this->redirectToRoute('client_credit_card_index');
    }
}

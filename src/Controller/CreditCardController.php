<?php

namespace App\Controller;

use App\Entity\CreditCard;
use App\Form\CreditCardType;
use App\Repository\CreditCardRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/credit/card")
 */
class CreditCardController extends AbstractController
{
    /**
     * @Route("/", name="credit_card_index", methods={"GET"})
     */
    public function index(CreditCardRepository $creditCardRepository): Response
    {
        return $this->render('credit_card/index.html.twig', [
            'credit_cards' => $creditCardRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="credit_card_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $creditCard = new CreditCard();
        $form = $this->createForm(CreditCardType::class, $creditCard);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($creditCard);
            $entityManager->flush();

            return $this->redirectToRoute('credit_card_index');
        }

        return $this->render('credit_card/new.html.twig', [
            'credit_card' => $creditCard,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="credit_card_show", methods={"GET"})
     */
    public function show(CreditCard $creditCard): Response
    {
        return $this->render('credit_card/show.html.twig', [
            'credit_card' => $creditCard,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="credit_card_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CreditCard $creditCard): Response
    {
        $form = $this->createForm(CreditCardType::class, $creditCard);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('credit_card_index');
        }

        return $this->render('credit_card/edit.html.twig', [
            'credit_card' => $creditCard,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="credit_card_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CreditCard $creditCard): Response
    {
        if ($this->isCsrfTokenValid('delete'.$creditCard->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($creditCard);
            $entityManager->flush();
        }

        return $this->redirectToRoute('credit_card_index');
    }
}

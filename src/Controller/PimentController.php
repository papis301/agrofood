<?php

namespace App\Controller;

use App\Entity\Piment;
use App\Form\PimentType;
use App\Repository\PimentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/piment')]
final class PimentController extends AbstractController
{
    #[Route(name: 'app_piment_index', methods: ['GET'])]
    public function index(PimentRepository $pimentRepository): Response
    {
        return $this->render('piment/index.html.twig', [
            'piments' => $pimentRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_piment_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $piment = new Piment();
        $form = $this->createForm(PimentType::class, $piment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($piment);
            $entityManager->flush();

            return $this->redirectToRoute('app_piment_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('piment/new.html.twig', [
            'piment' => $piment,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_piment_show', methods: ['GET'])]
    public function show(Piment $piment): Response
    {
        return $this->render('piment/show.html.twig', [
            'piment' => $piment,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_piment_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Piment $piment, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PimentType::class, $piment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_piment_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('piment/edit.html.twig', [
            'piment' => $piment,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_piment_delete', methods: ['POST'])]
    public function delete(Request $request, Piment $piment, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$piment->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($piment);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_piment_index', [], Response::HTTP_SEE_OTHER);
    }
}

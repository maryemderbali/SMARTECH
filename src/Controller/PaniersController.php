<?php

namespace App\Controller;

use App\Entity\Paniers;
use App\Form\PaniersType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/paniers')]
class PaniersController extends AbstractController
{
    #[Route('/', name: 'app_paniers_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $paniers = $entityManager
            ->getRepository(Paniers::class)
            ->findAll();

        return $this->render('paniers/index.html.twig', [
            'paniers' => $paniers,
        ]);
    }

    #[Route('/new', name: 'app_paniers_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $panier = new Paniers();
        $form = $this->createForm(PaniersType::class, $panier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($panier);
            $entityManager->flush();

            return $this->redirectToRoute('app_paniers_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('paniers/new.html.twig', [
            'panier' => $panier,
            'form' => $form,
        ]);
    }

    #[Route('/{panierId}', name: 'app_paniers_show', methods: ['GET'])]
    public function show(Paniers $panier): Response
    {
        return $this->render('paniers/show.html.twig', [
            'panier' => $panier,
        ]);
    }

    #[Route('/{panierId}/edit', name: 'app_paniers_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Paniers $panier, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PaniersType::class, $panier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_paniers_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('paniers/edit.html.twig', [
            'panier' => $panier,
            'form' => $form,
        ]);
    }

    #[Route('/{panierId}', name: 'app_paniers_delete', methods: ['POST'])]
    public function delete(Request $request, Paniers $panier, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$panier->getPanierId(), $request->request->get('_token'))) {
            $entityManager->remove($panier);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_paniers_index', [], Response::HTTP_SEE_OTHER);
    }
}

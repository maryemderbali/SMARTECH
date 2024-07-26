<?php

namespace App\Controller;

use App\Entity\TypeProduit;
use App\Form\TypeProduitType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/type/produit')]
class TypeProduitController extends AbstractController
{
    #[Route('/', name: 'app_type_produit_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $typeProduits = $entityManager
            ->getRepository(TypeProduit::class)
            ->findAll();

        return $this->render('type_produit/index.html.twig', [
            'type_produits' => $typeProduits,
        ]);
    }

    #[Route('/new', name: 'app_type_produit_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $typeProduit = new TypeProduit();
        $form = $this->createForm(TypeProduitType::class, $typeProduit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($typeProduit);
            $entityManager->flush();

            return $this->redirectToRoute('app_type_produit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('type_produit/new.html.twig', [
            'type_produit' => $typeProduit,
            'form' => $form,
        ]);
    }

    #[Route('/{idt}', name: 'app_type_produit_show', methods: ['GET'])]
    public function show(TypeProduit $typeProduit): Response
    {
        return $this->render('type_produit/show.html.twig', [
            'type_produit' => $typeProduit,
        ]);
    }

    #[Route('/{idt}/edit', name: 'app_type_produit_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TypeProduit $typeProduit, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TypeProduitType::class, $typeProduit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_type_produit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('type_produit/edit.html.twig', [
            'type_produit' => $typeProduit,
            'form' => $form,
        ]);
    }

    #[Route('/{idt}', name: 'app_type_produit_delete', methods: ['POST'])]
    public function delete(Request $request, TypeProduit $typeProduit, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typeProduit->getIdt(), $request->request->get('_token'))) {
            $entityManager->remove($typeProduit);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_type_produit_index', [], Response::HTTP_SEE_OTHER);
    }
}

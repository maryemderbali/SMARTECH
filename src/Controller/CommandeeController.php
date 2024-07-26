<?php

namespace App\Controller;

use App\Entity\Commandee;
use App\Form\CommandeeType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/commandee')]
class CommandeeController extends AbstractController
{
    #[Route('/', name: 'app_commandee_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $commandees = $entityManager
            ->getRepository(Commandee::class)
            ->findAll();

        return $this->render('commandee/index.html.twig', [
            'commandees' => $commandees,
        ]);
    }

    #[Route('/new', name: 'app_commandee_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $commandee = new Commandee();
        $form = $this->createForm(CommandeeType::class, $commandee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($commandee);
            $entityManager->flush();

            return $this->redirectToRoute('app_commandee_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('commandee/new.html.twig', [
            'commandee' => $commandee,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_commandee_show', methods: ['GET'])]
    public function show(Commandee $commandee): Response
    {
        return $this->render('commandee/show.html.twig', [
            'commandee' => $commandee,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_commandee_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Commandee $commandee, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CommandeeType::class, $commandee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_commandee_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('commandee/edit.html.twig', [
            'commandee' => $commandee,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_commandee_delete', methods: ['POST'])]
    public function delete(Request $request, Commandee $commandee, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$commandee->getId(), $request->request->get('_token'))) {
            $entityManager->remove($commandee);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_commandee_index', [], Response::HTTP_SEE_OTHER);
    }
}

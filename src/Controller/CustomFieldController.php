<?php

namespace App\Controller;

use App\Entity\CustomField;
use App\Form\CustomFieldType;
use App\Repository\CustomFieldRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/custom/field')]
final class CustomFieldController extends AbstractController
{
    #[Route(name: 'app_custom_field_index', methods: ['GET'])]
    public function index(CustomFieldRepository $customFieldRepository): Response
    {
        return $this->render('custom_field/index.html.twig', [
            'custom_fields' => $customFieldRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_custom_field_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $customField = new CustomField();
        $form = $this->createForm(CustomFieldType::class, $customField);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($customField);
            $entityManager->flush();

            return $this->redirectToRoute('app_custom_field_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('custom_field/new.html.twig', [
            'custom_field' => $customField,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_custom_field_show', methods: ['GET'])]
    public function show(CustomField $customField): Response
    {
        return $this->render('custom_field/show.html.twig', [
            'custom_field' => $customField,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_custom_field_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CustomField $customField, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CustomFieldType::class, $customField);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_custom_field_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('custom_field/edit.html.twig', [
            'custom_field' => $customField,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_custom_field_delete', methods: ['POST'])]
    public function delete(Request $request, CustomField $customField, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$customField->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($customField);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_custom_field_index', [], Response::HTTP_SEE_OTHER);
    }
}

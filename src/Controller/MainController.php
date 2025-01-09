<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\ContactRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/')]
final class MainController extends AbstractController
{
    #[Route(name: 'app_main', methods: ['GET'])]
    public function index(): Response
    {
        return $this->redirectToRoute('app_contact_index', [], Response::HTTP_SEE_OTHER);
    }
}


<?php

namespace App\Controller;

use App\Entity\Candidat;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CandidatController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/candidat', name: 'app_candidat')]
    public function index(): Response
    {
        $candidats = $this->entityManager->getRepository(Candidat::class)->findAll();
        return $this->render('candidat/index.html.twig', [
            'candidats' => $candidats
        ]);
    }
}
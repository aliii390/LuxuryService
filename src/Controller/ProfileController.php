<?php

namespace App\Controller;

use App\Entity\Candidat;
use App\Entity\User;
use App\Form\CandidatType;
use App\Repository\CandidatRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'app_profile')]
    public function index(CandidatRepository $candidatRepository, Request $request, EntityManagerInterface $entityManager): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        /**
         * @var User $user
         */
        $user = $this->getUser();

        $candidat = $candidatRepository->findOneBy(['user' => $user]);

        if ($candidat === null) {
            $candidat = new Candidat();
            $candidat->setUser($user);
        }

        $form = $this->createForm(CandidatType::class, $candidat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // if ($candidat->getCreatedAt() === null) {
            //     $candidat->setCreatedAt(new \DateTimeImmutable());
            // }
            
            // l'erreur vien de la je suis le goat j'ai trouver 

            // $candidat->setUpdatedAt(new \DateTimeImmutable());
            $entityManager->persist($candidat);
            $entityManager->flush();
            $this->addFlash('success', "Your profile has been updated!");
        }

        return $this->render('profile/index.html.twig', [
            'candidatForm' => $form->createView(),
        ]);
    }
}
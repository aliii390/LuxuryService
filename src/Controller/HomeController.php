<?php

namespace App\Controller;

use App\Enity\JobCategory;
use App\Entity\Candidature;
use App\Repository\CandidatRepository;
use App\Repository\JobCategoryRepository;
use App\Repository\JobOfferRepository;
use App\Service\CandidatComplet;
use Doctrine\ORM\EntityManagerInterface;
  use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index( JobOfferRepository $offreRepository , JobCategoryRepository $jobRepository , 
    EntityManagerInterface $entityManager , CandidatRepository $candidatRepository ,CandidatComplet $completionCalculator): Response
    {

                /** 
         * @var User $user
         */
        $user = $this->getUser();
        
        if($user){
          $candidate = $candidatRepository->findOneBy(['user' => $user->getId()]);
          $existingCandidatures = $entityManager->getRepository(Candidature::class)->findBy(['candidat' => $candidate]);
          $completionRate = $completionCalculator->calculateCompletion($candidate);
  
        }else{
           $existingCandidatures = [];
           $completionRate = 0;
        }

        



        $offres = $offreRepository->findAll();
        $jobs = $jobRepository->findAll();
     
      
        return $this->render('home/index.html.twig', [
          'offre' => $offres,
          'jobs' => $jobs,
          'existingCandidatures' => $existingCandidatures,
          'completionRate' => $completionRate,
          
        ]);
    }
}

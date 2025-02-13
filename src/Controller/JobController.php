<?php

namespace App\Controller;

use App\Entity\Candidature;
use App\Entity\JobCategory;
use App\Entity\JobOffer;
use App\Repository\CandidatRepository;
use App\Repository\JobCategoryRepository;
use App\Repository\JobOfferRepository;
use App\Repository\TypeContratRepository;
use App\Service\CandidatComplet;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class JobController extends AbstractController
{
    #[Route('/job', name: 'app_job')]
    public function index(JobOfferRepository $offreRepository , 
    JobCategoryRepository $jobRepository , 
    TypeContratRepository $contrat , 
    PaginatorInterface $paginator , Request $request , 
    CandidatRepository $candidatRepository , EntityManagerInterface $entityManager , CandidatComplet $completionCalculator
    ): Response
    {

        
        $offres = $offreRepository->findAll();
        $jobs = $jobRepository->findAll();
        $typeContrat = $contrat->findAll();



            /** 
         * @var User $user
         */
        $user = $this->getUser();
        $candidate = $candidatRepository->findOneBy(['user' => $user->getId()]);



        $pagination = $paginator->paginate(
            $offres, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            2 /*limit per page*/
        );


        $existingCandidatures = $entityManager->getRepository(Candidature::class)->findBy(['candidat' => $candidate]);
        $completionRate = $completionCalculator->calculateCompletion($candidate);
        // dd($existingCandidatures);
        return $this->render('job/index.html.twig', [
            
            'offre' => $pagination,
          'jobs' => $jobs,
          'contrat' => $typeContrat,
          'existingCandidatures' => $existingCandidatures,
          'completionRate' => $completionRate,


        ]);
    }

    #[Route('/job/{id}', name: 'app_job_show')]
    public function show(JobOffer $offre): Response
    {

        return $this->render('job/show.html.twig', [
         'offer'=>$offre
        ]);
    }
}

<?php

namespace App\Controller;

use App\Entity\JobCategory;
use App\Entity\JobOffer;
use App\Repository\JobCategoryRepository;
use App\Repository\JobOfferRepository;
use App\Repository\TypeContratRepository;
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
    PaginatorInterface $paginator , Request $request): Response
    {

        
        $offres = $offreRepository->findAll();
        $jobs = $jobRepository->findAll();
        $typeContrat = $contrat->findAll();

        $pagination = $paginator->paginate(
            $offres, /* query NOT result */
            $request->query->getInt('page', 4), /*page number*/
            3 /*limit per page*/
        );

        return $this->render('job/index.html.twig', [
            
            'offre' => $pagination,
          'jobs' => $jobs,
          'contrat' => $typeContrat

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

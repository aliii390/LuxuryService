<?php

namespace App\Controller;

use App\Enity\JobCategory;
use App\Repository\JobCategoryRepository;
use App\Repository\JobOfferRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index( JobOfferRepository $offreRepository , JobCategoryRepository $jobRepository): Response
    {

        $offres = $offreRepository->findAll();
        $jobs = $jobRepository->findAll();
    


        return $this->render('home/index.html.twig', [
          'offre' => $offres,
          'jobs' => $jobs,
        ]);
    }
}

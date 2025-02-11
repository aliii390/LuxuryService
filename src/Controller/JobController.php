<?php

namespace App\Controller;

use App\Entity\JobOffer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class JobController extends AbstractController
{
    #[Route('/job', name: 'app_job')]
    public function index(): Response
    {
        return $this->render('job/index.html.twig', [
         
        ]);
    }

    #[Route('{id}/job/', name: 'app_job_show')]
    public function show(JobOffer $offre): Response
    {

        return $this->render('job/show.html.twig', [
         'offer'=>$offre
        ]);
    }
}

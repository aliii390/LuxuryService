<?php

namespace App\Controller\Pro;

use App\Entity\Candidature;
use App\Entity\Client;
use App\Entity\JobOffer;
use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminDashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[AdminDashboard(routePath: '/admin', routeName: 'admin')]
class ProController extends AbstractDashboardController
{
    #[Route('/pro')]
    public function index(): Response
    {
        

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // 1.1) If you have enabled the "pretty URLs" feature:
        // return $this->redirectToRoute('admin_user_index');
        //
        // 1.2) Same example but using the "ugly URLs" that were used in previous EasyAdmin versions:
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirectToRoute('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
         return $this->render('pro/pro.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('User Professionel')
            ->setFaviconPath('img/luxury-services-logo.png');
    }

    public function configureMenuItems(): iterable
    {

    /**
         * @var User $user
         */
        $user = $this->getUser();
        $roles = $user->getRoles();

        if(in_array('ROLE_PRO' , $roles)){
            yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
            // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);

            yield MenuItem::section("Compte");
            yield MenuItem::linkToCrud('Profil', 'fas fa-user', Client::class);
    
            yield MenuItem::section("Postez Offre d'emploi");
            yield MenuItem::linkToCrud('Offre emploi', 'fas fa-user', JobOffer::class);

            // ->setEntityId($user->getId());
    
            yield MenuItem::section("Voir Les candidatures");
            yield MenuItem::linkToCrud('Candidature', 'fas fa-user', Candidature::class);

        }




      
    }




    
}

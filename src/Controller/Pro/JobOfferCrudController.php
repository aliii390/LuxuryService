<?php

namespace App\Controller\Pro;

use App\Entity\JobOffer;
use App\Entity\User;
use App\Repository\JobOfferRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FilterCollection;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Orm\EntityRepository;
use Symfony\Bundle\SecurityBundle\Security;

class JobOfferCrudController extends AbstractCrudController
{


    private Security $security;
    private EntityRepository $entityRepository;
    private JobOfferRepository $offreEmploiRepository;

    public function __construct(Security $security, EntityRepository $entityRepository, JobOfferRepository $offreEmploiRepository)
    {
        $this->security = $security;
        $this->entityRepository = $entityRepository;
        $this->offreEmploiRepository = $offreEmploiRepository;
    }





    public static function getEntityFqcn(): string
    {
        return JobOffer::class;
    }



    public function createEntity(string $entityFqcn)
    {
        /** @var User */
        $user = $this->security->getUser();
        // $existingOffre = $this->offreEmploiRepository->findOneBy(['client' => $user->getClient()]);
        // dd($existingOffre);

        // if ($existingOffre) {
        //     $this->addFlash('danger', 'Vous avez déjà créé une offre d\'emploi.');
        //     return null;  // Ou rediriger vers une autre page
        // }

        $offreEmploi = new JobOffer();
        $offreEmploi->setClient($user->getClient());
        return $offreEmploi;

    }




    // public function configureCrud(Crud $crud): Crud
    // {
    //     return $crud
    //         ->setEntityPermission('ROLE_PRO');
    // }






    public function createIndexQueryBuilder(SearchDto $searchDto, EntityDto $entityDto, FieldCollection $fields, FilterCollection $filters): QueryBuilder
    {

      
        $response = $this->entityRepository->createQueryBuilder($searchDto, $entityDto, $fields, $filters);
          /** @var User */
        $response->andWhere('entity.client = :client')->setParameter('client', $this->security->getUser()->getClient());

        return $response;
    }




    // public function configureActions(Actions $actions): Actions
    // {
    //     $user = $this->security->getUser();
    //     $existingOffre = $this->offreEmploiRepository->findOneBy(['client' => $user->getClient()]);

    //     if ($existingOffre) {
    //         return $actions
    //             ->disable(Action::NEW);
    //     }

    //     return $actions;
    // }



    
    public function configureFields(string $pageName): iterable
    {
        return [
           
            TextField::new('name'),
            TextField::new('Location'),
            TextField::new('Salaire'),
            TextField::new('description'),
            TextField::new('date'),
            AssociationField::new('jobCategory'),
            AssociationField::new('contrat'),
            // TextField::new('companyname')
        ];
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if ($entityInstance instanceof JobOffer) {
            /** @var User */
            $user = $this->security->getUser();
            $entityInstance->setClient($user->getClient());
        }

        parent::persistEntity($entityManager, $entityInstance);
    }

    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if ($entityInstance instanceof JobOffer) {
              /** @var User */
            $user = $this->security->getUser();
            $entityInstance->setClient($user->getClient());
        }

        parent::updateEntity($entityManager, $entityInstance);
    }





    
}

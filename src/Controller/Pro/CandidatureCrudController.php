<?php

namespace App\Controller\Pro;

use App\Entity\Candidature;
use App\Repository\CandidatureRepository;
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
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Orm\EntityRepository;
use Symfony\Bundle\SecurityBundle\Security;

class CandidatureCrudController extends AbstractCrudController
{



    private Security $security;
    private EntityRepository $entityRepository;
    private CandidatureRepository $candidateRepository;

    public function __construct(
        Security $security,
        EntityRepository $entityRepository,
        CandidatureRepository $candidateRepository
    ) {
        $this->security = $security;
        $this->entityRepository = $entityRepository;
        $this->candidateRepository = $candidateRepository;
    }


    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->disable(Action::NEW); // Désactiver l'action NEW pour empêcher l'ajout de nouvelles candidature
    }



    public function createIndexQueryBuilder(SearchDto $searchDto, EntityDto $entityDto, FieldCollection $fields, FilterCollection $filters): QueryBuilder
    {
        $response = $this->entityRepository->createQueryBuilder($searchDto, $entityDto, $fields, $filters);
        $response->innerJoin('entity.offreEmploi', 'jobOffer')
            ->innerJoin('entity.candidat', 'candidat')
            ->andWhere('jobOffer.client = :client')
            ->setParameter('client', $this->security->getUser()->getClient());

        return $response;
    }

    public static function getEntityFqcn(): string
    {
        return Candidature::class;
    }

    public function configureFields(string $pageName): iterable
    {


        if ($pageName === Crud::PAGE_INDEX || $pageName === Crud::PAGE_DETAIL) {
            return [
                IdField::new('id')->hideOnForm(),
                TextField::new('candidat.lastname', 'Nom du candidat'),
                TextField::new('candidat.firstname', 'Nom du candidat'),
                TextField::new('offreEmploi.name', 'Titre du job'),
                TextField::new('offreEmploi.salaire', 'Salaire proposé'),
                TextField::new('offreEmploi.jobCategory', 'La catégorie de l\'offre d\'emploi'),
                TextField::new('status', 'Statut'),
            ];
        } elseif ($pageName === Crud::PAGE_EDIT) {
            return [
                IdField::new('id')->hideOnForm(),
                ChoiceField::new('status', 'Statut')
                    ->setChoices([
                        'En attente' => 'pending',
                        'Acceptée' => 'accepted',
                        'Refusée' => 'rejected'
                    ]),
            ];
        }

        return [];
    }
    
}

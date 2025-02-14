<?php

namespace App\Controller\Pro;

use App\Entity\Client;
use App\Repository\ClientRepository;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FilterCollection;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Orm\EntityRepository;
use Symfony\Bundle\SecurityBundle\Security;

class ClientCrudController extends AbstractCrudController
{


    private Security $security;
    private EntityRepository $entityRepository;
    private ClientRepository $clientRepository;


    public function __construct(Security $security , EntityRepository $entityRepository , ClientRepository $clientRepository)
    {
        $this->security = $security;
        $this->entityRepository = $entityRepository;
        $this->clientRepository = $clientRepository;
    }



    public static function getEntityFqcn(): string
    {
        return Client::class;
    }



    public function createEntity(string $entityFqcn)
    {
        $user = $this->security->getUser();
        $existingClient = $this->clientRepository->findOneBy(['user' => $user]);

        if ($existingClient) {
            $this->addFlash('danger', 'Vous avez déjà créé un client.');
            return null;  // Ou rediriger vers une autre page
        }

        $client = new Client();
        $client->setUser($this->security->getUser());
        return $client;
    }




    public function createIndexQueryBuilder(SearchDto $searchDto, EntityDto $entityDto, FieldCollection $fields, FilterCollection $filters): QueryBuilder
    {
        $response = $this->entityRepository->createQueryBuilder($searchDto, $entityDto, $fields, $filters);
        $response->andWhere('entity.user = :user')->setParameter('user', $this->getUser());

        return $response;
    }

    

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nom_de_la_societe'),
            TextField::new('type_activite'),            
            TextField::new('nom_du_contact'),            
            TextField::new('post'),            
            TextField::new('numero_du_contact'),            
            TextField::new('email_du_contact'),            
            TextField::new('notes'),            
        ];
    }
    


// function: une fois qu'on a créér son profil on peut plus en créer un autre on peut juste l'édit 

    public function configureActions(Actions $actions): Actions
    {
        $user = $this->security->getUser();
        $existingClient = $this->clientRepository->findOneBy(['user' => $user]);

        if ($existingClient) {
            return $actions
                ->disable(Action::NEW);
        }

        return $actions;
    }

  

}

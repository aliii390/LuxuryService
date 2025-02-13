<?php

namespace App\Controller\Pro;

use App\Entity\JobOffer;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class JobOfferCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return JobOffer::class;
    }

    
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
            TextField::new('companyname')
        ];
    }
    
}

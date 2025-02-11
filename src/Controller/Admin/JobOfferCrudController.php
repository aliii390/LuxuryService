<?php

namespace App\Controller\Admin;

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
            TextField::new('location'),
            TextField::new('salaire'),
            TextField::new('date'),
            AssociationField::new('jobCategory')->autocomplete('name'),
            TextField::new('description'),
        ];
    }
    
}

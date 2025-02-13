<?php

namespace App\Controller\Pro;

use App\Entity\Candidature;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CandidatureCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Candidature::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
           
            AssociationField::new('offreEmploi'),
            AssociationField::new('candidat'),
            DateField::new('createdAt'),
            DateField::new('updatedAt'),
            DateField::new('deletedAt'),
          

           
            
        ];
    }
    
}

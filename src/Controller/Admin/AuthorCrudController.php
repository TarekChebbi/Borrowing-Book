<?php

namespace App\Controller\Admin;

use App\Entity\Author;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class AuthorCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Author::class;
    }
    public function configureFields(string $pageName): iterable
    {return[
        FormField::addTab('first tab'),
        FormField::addPanel('aa'),
        TextField::new('name')->setColumns('col-sm-6 col-xxl-3 offset-lg-1 order-3'),
        TextField::new('surname')->setColumns('col-sm-6 col-xxl-3 offset-lg-1 order-3')
    ];
        
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}

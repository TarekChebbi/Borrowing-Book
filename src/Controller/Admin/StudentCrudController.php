<?php

namespace App\Controller\Admin;

use App\Entity\Student;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class StudentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Student::class;
    }
    /*public function configureCrud(Crud $crud): Crud
    {
        $crud = Crud::new();
        return $crud
        ->setPaginatorPageSize(10) 
        ->setPaginatorRangeSize(4)
        ->setEntityPermission('ROLE_ADMIN');
    }
*/
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

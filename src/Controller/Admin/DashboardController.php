<?php

namespace App\Controller\Admin;
use App\Entity\Student;
use App\Entity\Author;
use App\Entity\Borrowing;
use App\Entity\Book;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;

class DashboardController extends AbstractDashboardController
{
    #[Route('/', name: 'admin')]
    public function index(): Response
    {
        // Comment out this line
       //  return parent::index();
        
        // Uncomment these lines
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(AuthorCrudController::class)->generateUrl());
    }
    public function index2(): Response
     {
         $routeBuilder = $this->container->get(AdminUrlGenerator::class); 
         $url = $routeBuilder->setController(BorrowingCrudController::class)->generateUrl();
         return $this->redirect($url); // return parent::index();
         }
         public function index3(): Response
         {
             $routeBuilder = $this->container->get(AdminUrlGenerator::class); 
             $url = $routeBuilder->setController(BookCrudController::class)->generateUrl();
             return $this->redirect($url); // return parent::index();
             }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Student', 'fas fa-chalkboard-teacher', Student::class);
        yield MenuItem::linkToCrud('Author', 'fas fa-chalkboard-teacher', Author::class);
       yield MenuItem::linkToCrud('Borrowing', 'fas fa-book-reader', Borrowing::class);
       yield MenuItem::linkToCrud('Book', 'fas fa-book-reader', Book::class);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('<h2>Librarian</h2>')
            ->renderContentMaximized();
    }
   
}

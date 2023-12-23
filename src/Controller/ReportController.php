<?php

namespace App\Controller;
use App\Form\BookSearchType;
use App\Entity\BookSearch;
use App\Entity\Student;
use App\Form\StudentSearchType;
use App\Entity\StudentSearch;
use App\Form\DateRangeSearchType;
use App\Entity\DateRangeSearch;
use Symfony\Component\HttpFoundation\Request;

use App\Form\BookType;
use App\Repository\BorrowingRepository;
use Container9W4iCTl\getBorrowingRepositoryService;
use PhpParser\Builder\Class_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReportController extends AbstractController
{
    #[Route('/most-popular-book', name: 'most_popular_book')]
    public function index(BorrowingRepository $borrowingRepository): Response
    {
       // $books = $borrowingRepository->findMostPopularBooks();
        $books = $borrowingRepository->findMostPopularBooksDql();
        return $this->render('report/index.html.twig', [
            'books' => $books, // Pass the 'books' variable to the template
        ]);

        
    }
    #[Route('/borrowingsearch')]
    public function searchBorrowings(Request $request, BorrowingRepository $repository): Response
    {
        $bookSearch = new BookSearch();
        $studentSearch = new StudentSearch();
    
        $bookForm = $this->createForm(BookSearchType::class, $bookSearch);
        $studentForm = $this->createForm(StudentSearchType::class, $studentSearch);
    
        $bookForm->handleRequest($request);
        $studentForm->handleRequest($request);
    
        $borrowings = [];
    
        if ($bookForm->isSubmitted() && $bookForm->isValid()) {
            $book = $bookSearch->getBook();
            $month = $bookSearch->getMonth();
            if ($book !== "") {
                $borrowings = $repository->findBy(['book' => $book]);
            } else {
                $borrowings = $repository->findAll();
            }
        } elseif ($studentForm->isSubmitted() && $studentForm->isValid()) {
            $student = $studentSearch->getStudent();
    
            if ($student !== null && $student !== '') {
                $borrowings = $repository->findBy(['student' => $student]);
            } else {
                $borrowings = $repository->findAll();
            }
        }
    
        return $this->render('report/BorrowingStudent.html.twig', [
            'bookForm' => $bookForm->createView(),
            'studentForm' => $studentForm->createView(),
            'borrowings' => $borrowings,
        ]);
    }








    #[Route('/borrowingmois')]
    public function searchmois(Request $request, BorrowingRepository $repository): Response
    {
        $bookSearch = new BookSearch();
        
        $bookForm = $this->createForm(BookSearchType::class, $bookSearch);
        
        $bookForm->handleRequest($request);
        
        $borrowings = [];
        
        if ($bookForm->isSubmitted() && $bookForm->isValid()) {
            $book = $bookSearch->getBook();
            $month = $bookSearch->getMonth();
        
            $criteria = [];
        
            if ($book !== null) {
                $criteria['book'] = $book;
            }
        
            if ($month !== null) {
                $criteria['month'] = $month;
            }
        
            if (!empty($criteria)) {
                $borrowings = $repository->findBy($criteria);
            } else {
                $borrowings = $repository->findAll();
            }
        
        return $this->render('report/BorrowingBook.html.twig', [
            'bookForm' => $bookForm->createView(),
            'borrowings' => $borrowings,
        ]);
    }
    


   
}


#[Route('/borrowingrange')]
public function searchBetweenDates(Request $request, BorrowingRepository $repository): Response
{
    $dateRangeSearch = new DateRangeSearch();
    $dateRangeForm = $this->createForm(DateRangeSearchType::class, $dateRangeSearch);
    $dateRangeForm->handleRequest($request);

    $borrowings = [];

    if ($dateRangeForm->isSubmitted() && $dateRangeForm->isValid()) {
        $startDate = $dateRangeSearch->getStartDate();
        $endDate = $dateRangeSearch->getEndDate();

        // Perform the search using the date range
        if ($startDate !== null && $endDate !== null) {
            $borrowings = $repository->findByDateRange($startDate, $endDate);
        } else {
            $borrowings = $repository->findAll();
        }
    }

    return $this->render('report/BorrowingDateRange.html.twig', [
        'dateRangeForm' => $dateRangeForm->createView(),
        'borrowings' => $borrowings,
    ]);
}


}
<?php

namespace App\Controller;
use App\Entity\ResetPassword;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;
use App\Classe\Mail;

use DateTimeImmutable;

class ResetPasswordController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    
    #[Route('/forgot-password', name: 'app_reset_password')]
    public function index(Request $request): Response
    {
        if ($this->getUser()) { return $this->redirectToRoute('app_borrowing_index'); }
        if ($request->get('email'))
   {
            // Find the user by email in the database
            $user = $this->entityManager->getRepository(User::class)->findOneByemail($request->get('email'));

            // Dump the user for testing
           // dd($user);
           if ($user)
        {
            $resetPassword = new ResetPassword();
            $resetPassword->setUser($user)
            ->setToken(uniqid())
            ->setCreatedAt(new DateTimeImmutable());
            $this->entityManager->persist($resetPassword);
            $this->entityManager->flush();
            $url= $this->generateUrl('update_password',[
                'token'=>$resetPassword->getToken()
            ]);
            $content ="Hello ".$user->getEmail()."<br> In order to reset
            your password, please click on the following link :<br> ";
            $content .="<a href='".$url."'>Reset your password</a>.";
            $mail= new Mail();
            $mail->send($user->getEmail(),null ,'Reset your password', $content);
            $this->addFlash("notice", "An email has been sent to you !");
        }
            
     }
        return $this->render('reset_password/index.html.twig', [
            'controller_name' => 'ResetPasswordController',
        ]);
        
    
    }
    #[Route('/update-password/{token}', name: 'update_password')]
    public function reset($token)
    {
        dd($token);
    }
}

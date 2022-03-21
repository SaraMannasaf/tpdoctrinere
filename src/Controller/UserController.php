<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="app_user")
     */
    public function users()
    {
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();
        
        return $this->render('user/index.html.twig', [
            'users' => $users,
        ]);
    }
    
}

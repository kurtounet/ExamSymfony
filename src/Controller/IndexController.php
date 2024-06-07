<?php

namespace App\Controller;

use App\Entity\Character;
use App\Repository\CharacterRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class IndexController extends AbstractController
{   

    //Controller de la page about
    
    // Controller de la page login
    #[Route('/login', name: 'app_login')]
    public function login(): Response
    {
        return $this->render('login/login.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }
}

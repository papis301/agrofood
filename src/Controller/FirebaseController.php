<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FirebaseController extends AbstractController
{
    #[Route('/login/firebase', name: 'firebase_login')]
    public function login(): Response
    {
        return $this->render('firebase_login.html.twig');
    }
}

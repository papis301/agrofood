<?php

namespace App\Controller;

use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route(path: '/login', name: 'app_admin_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('admin_dashboard'); // app_home doit être PUBLIC
        }

        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);

         // URL pour le bouton "Se connecter avec Google"
        $googleLoginUrl = $this->generateUrl('connect_google_start');

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
            'google_login_url' => $googleLoginUrl,
        ]);
    }

    #[Route(path: '/login/check', name: 'app_admin_check')]
    public function check(): void
    {
        throw new \LogicException('Cette route est interceptée par le firewall.');
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('Cette méthode est interceptée par le firewall pour la déconnexion.');
    }

    #[Route('/connect/google', name: 'connect_google_start')]
        public function connectGoogle(ClientRegistry $clientRegistry)
        {
            return $clientRegistry->getClient('google')->redirect(['email','profile']);
        }

        #[Route('/connect/google/check', name: 'connect_google_check')]
        public function connectGoogleCheck()
        {
            throw new \LogicException('Intercepté par GoogleAuthenticator');
        }
}

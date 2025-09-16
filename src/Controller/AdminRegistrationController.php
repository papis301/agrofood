<?php

namespace App\Controller;

use App\Entity\Admin;
use App\Form\AdminRegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class AdminRegistrationController extends AbstractController
{
    #[Route('/admin/register', name: 'app_admin_register')]
    public function register(Request $request, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager): Response
    {
        $admin = new Admin();
        $form = $this->createForm(AdminRegistrationFormType::class, $admin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Hasher le mot de passe
            $admin->setPassword(
                $passwordHasher->hashPassword(
                    $admin,
                    $form->get('plainPassword')->getData()
                )
            );

            // ROLE_ADMIN par défaut
            $admin->setRoles(['ROLE_ADMIN']);

            $entityManager->persist($admin);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_login'); // ou page admin
        }

        return $this->render('registration/admin_register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}


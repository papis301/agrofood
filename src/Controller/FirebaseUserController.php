<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class FirebaseUserController extends AbstractController
{
    #[Route('/firebase/sync-user', name: 'firebase_sync_user', methods: ['POST'])]
    public function syncUser(Request $request, UserRepository $userRepo, EntityManagerInterface $em): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if (!$data || !isset($data['email'])) {
            return new JsonResponse(['error' => 'Email manquant'], 400);
        }

        $email = $data['email'];
        $username = $data['username'] ?? null;
        $phone = $data['phone'] ?? null;

        // Vérifier si l'utilisateur existe déjà
        $user = $userRepo->findOneBy(['email' => $email]);

        if (!$user) {
            // Créer un nouvel utilisateur
            $user = new User();
            $user->setEmail($email);
            $user->setUsername($username);
            $user->setPhone($phone);

            $em->persist($user);
            $em->flush();

            return new JsonResponse(['status' => 'created', 'id' => $user->getId()]);
        }

        return new JsonResponse(['status' => 'exists', 'id' => $user->getId()]);
    }
}

// namespace App\Controller;

// use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
// use Symfony\Component\HttpFoundation\Response;
// use Symfony\Component\Routing\Attribute\Route;

// final class FirebaseUserController extends AbstractController
// {
//     #[Route('/firebase/user', name: 'app_firebase_user')]
//     public function index(): Response
//     {
//         return $this->render('firebase_user/index.html.twig', [
//             'controller_name' => 'FirebaseUserController',
//         ]);
//     }
// }

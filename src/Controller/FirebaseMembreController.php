<?php
// src/Controller/FirebaseMembreController.php
namespace App\Controller;

use App\Entity\Membre;
use App\Repository\MembreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class FirebaseMembreController extends AbstractController
{
    #[Route('/firebase/sync-membre', name: 'firebase_sync_membre', methods: ['POST'])]
    public function syncMembre(
        Request $request, 
        MembreRepository $membreRepo, 
        EntityManagerInterface $em
    ): JsonResponse {
        $data = json_decode($request->getContent(), true);

        if (!$data || !isset($data['email'])) {
            return new JsonResponse(['error' => 'Email manquant'], 400);
        }

        $email = $data['email'];
        $username = $data['username'] ?? null;
        $phone = $data['phone'] ?? null;

        // Vérifier si le membre existe déjà
        $membre = $membreRepo->findOneBy(['email' => $email]);

        if (!$membre) {
            // Créer un nouveau membre
            $membre = new Membre();
            $membre->setEmail($email);
            $membre->setNomUtilisateur($username);
            $membre->setTelephone($phone);

            $em->persist($membre);
            $em->flush();

            return new JsonResponse(['status' => 'created', 'id' => $membre->getId()]);
        }

        return new JsonResponse(['status' => 'exists', 'id' => $membre->getId()]);
    }
}

// namespace App\Controller;

// use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
// use Symfony\Component\HttpFoundation\Response;
// use Symfony\Component\Routing\Attribute\Route;

// final class FirebaseMembreController extends AbstractController
// {
//     #[Route('/firebase/membre', name: 'app_firebase_membre')]
//     public function index(): Response
//     {
//         return $this->render('firebase_membre/index.html.twig', [
//             'controller_name' => 'FirebaseMembreController',
//         ]);
//     }
// }

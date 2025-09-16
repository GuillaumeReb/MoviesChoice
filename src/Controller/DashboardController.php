<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'app_dashboard')]
    #[IsGranted('ROLE_USER')]
    public function index(): Response
    {
        $user = $this->getUser();
        
        // Ici vous pourrez récupérer les DVD, favoris, etc. de l'utilisateur
        // Exemple (à adapter selon vos entités) :
        // $userDvds = $this->getDoctrine()->getRepository(Dvd::class)->findByUser($user);
        // $userFavorites = $this->getDoctrine()->getRepository(Favorite::class)->findByUser($user);
        
        return $this->render('dashboard/index.html.twig', [
            'user' => $user,
            // 'dvds' => $userDvds,
            // 'favorites' => $userFavorites,
        ]);
    }
}
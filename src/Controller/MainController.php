<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Service\TmdbService;

class MainController extends AbstractController
{
    private $tmdbService;

    // Injecter le service TmdbService dans le constructeur
    public function __construct(TmdbService $tmdbService)
    {
        $this->tmdbService = $tmdbService;
    }

     /**
     * @Route("/", name="app_home")
     */

    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        // return $this->render('main/index.html.twig', [
        //     'controller_name' => 'MainController',
        // ]);

        // Récupérer les films populaires depuis le service
        $popularMovies = $this->tmdbService->getPopularMovies();
        // Récupérer les séries populaires depuis le service
        $popularTvShows = $this->tmdbService->getPopularTvShows();

        // Passer les résultats à la vue
        return $this->render('index.html.twig', [
            'popularMovies' => $popularMovies,
            'popularTvShows' => $popularTvShows,
        ]);

    }
}

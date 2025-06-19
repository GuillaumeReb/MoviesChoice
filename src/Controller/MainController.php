<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Service\TmdbService;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class MainController extends AbstractController
{
    private $tmdbService;

    // Injecter le service TmdbService dans le constructeur
    public function __construct(TmdbService $tmdbService)
    {
        $this->tmdbService = $tmdbService;
    }

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

    #[Route('/film', name: 'app_films')]
public function films(): Response
{
    $popularMovies = $this->tmdbService->getPopularMovies();

    return $this->render('main/film.html.twig', [
        'popularMovies' => $popularMovies,
    ]);
}

#[Route('/serie', name: 'app_series')]
public function series(): Response
{
    $popularTvShows = $this->tmdbService->getPopularTvShows();

    return $this->render('main/serie.html.twig', [
        'popularTvShows' => $popularTvShows,
    ]);
}

// Pour SHOWFilm

#[Route('/movie/{id}', name: 'movie_show')]
public function showMovie(int $id, HttpClientInterface $client): Response
{
    $response = $client->request('GET', "https://api.themoviedb.org/3/movie/$id", [
        'query' => [
            'api_key' => $_ENV['TMDB_API_KEY'],
            'language' => 'fr-FR'
        ]
    ]);

    $movie = $response->toArray();

    return $this->render('main/filmshow.html.twig', [
        'movie' => $movie
    ]);
}

// Pour SHOWSerie

#[Route('/tv/{id}', name: 'tv_show')]
public function showSerie(int $id, HttpClientInterface $client): Response
{
    $response = $client->request('GET', "https://api.themoviedb.org/3/tv/$id", [
        'query' => [
            'api_key' => $_ENV['TMDB_API_KEY'],
            'language' => 'fr-FR'
        ]
    ]);

    $serie = $response->toArray();

    return $this->render('main/serieshow.html.twig', [
        'tvShow' => $serie
    ]);
}

}

<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class TmdbService
{
    private $client;
    private $apiKey;

    // Injecte le client HTTP et la clé API dans le constructeur
    public function __construct(HttpClientInterface $client, string $apiKey)
    {
        $this->client = $client;
        $this->apiKey = $apiKey;

        if (empty($this->apiKey)) {
            throw new \Exception("API Key not resolved. Ensure TMDB_API_KEY is correctly set.");
        }
    }

    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    // Fonction pour récupérer les films populaires
    public function getPopularMovies()
    {
        // Appel à l'API pour récupérer les films populaires
        $response = $this->client->request('GET', 'https://api.themoviedb.org/3/movie/popular', [
            'query' => [
                'api_key' => $this->apiKey,  // Clé API
                'language' => 'fr',           // Langue des résultats
            ]
        ]);

        // Retourne les résultats sous forme de tableau
        return $response->toArray()['results'] ?? [];
    }

    // Fonction pour récupérer les séries populaires
    public function getPopularTvShows()
    {
        // Appel à l'API pour récupérer les séries populaires
        $response = $this->client->request('GET', 'https://api.themoviedb.org/3/tv/popular', [
            'query' => [
                'api_key' => $this->apiKey,  // Clé API
                'language' => 'fr',           // Langue des résultats
            ]
        ]);

        // Retourne les résultats sous forme de tableau
        return $response->toArray()['results'] ?? [];
    }
}

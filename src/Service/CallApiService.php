<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class CallApiService
{
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function getPlanetData($i): array
    {
        echo " Je suis dans la fonction getPlanetData";
        $response = $this->client->request(
            'GET',
            'https://dragonball-api.com/api/planets?page=' . $i . '&limit=10'
        );
        return $response->toArray();
    }
    public function getCharacterData($i): array|false
    {
        echo " Je suis dans la fonction getCharacterData";

        $response = $this->client->request(
            'GET',
            'https://dragonball-api.com/api/characters/' . $i
        );
        if ($response->getStatusCode() === 404) {
            return false;
        } else {
            return $response->toArray();
        }



    }


}
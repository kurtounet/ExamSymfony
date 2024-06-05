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
    public function getCharacterData($i): array
    {
        echo " Je suis dans la fonction getCharacterData";
        try {
            $response = $this->client->request(
                'GET',
                'https://dragonball-api.com/api/characters/' . $i
            );
            return $response->toArray();
        } catch (\Exception $e) {
            return $e->getMessage();
        }

    }


}
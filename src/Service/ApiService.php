<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class ApiService
{

    private HttpClientInterface $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function getPlayerByID(int $id): array|null
    {
        $response = $this->client->request(
            'GET',
            'https://www.balldontlie.io/api/v1/players/'.$id
        );
        return $response->toArray();
    }

    public function getPlayersByName(String $name, int $page): array|null
    {
        $response = $this->client->request(
            'GET',
            'https://www.balldontlie.io/api/v1/players?search='.$name.'&page='.$page
        );
        return $response->toArray();
    }

    public function getPlayerAverages($ids): array|null
    {
        $paramaters = "";
        foreach ($ids as $id) {
            $paramaters.="player_ids[]=".$id."&";
        }
        $response = $this->client->request(
            'GET',
            'https://www.balldontlie.io/api/v1/season_averages?'.$paramaters
        );
        return $response->toArray();
    }
}
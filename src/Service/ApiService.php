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
        $response = $response->toArray()['data'];
        $not_found=[];

        if(sizeof($response)==0) {
            return [
                'response'=>$response,
                'not_found'=>$ids
            ];
        }

        else {
            foreach ($ids as $id) {
                for($i=0; $i<sizeof($response); $i++) {
                    if($id!=$response[$i]['player_id'] && $i==sizeof($response)-1) {
                        $not_found[]=$id;
                        break;
                    }
                    elseif($id==$response[$i]['player_id']) {
                        break;
                    }
                }
            }
        }

        return [
            'response'=>$response,
            'not_found'=>$not_found
        ];
    }
}
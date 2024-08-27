<?php

namespace App\Services;
use GuzzleHttp\Client;

class FurnitureAPIService
{

    public function allProduct($limit = 0)
    {
        $client = new Client();
        $all_product = $client->request('GET', 'https://furni-store.kihub.net/api/products?limit='.$limit);

        if ($all_product->getStatusCode() == 200) {
            $response = json_decode($all_product->getBody()->getContents(), true)['datas'];
        } else {
            $response = [];
        }

        return $response;
    }

    public function allType()
    {
        $client = new Client();
        $types = $client->request('GET', 'https://furni-store.kihub.net/api/types');

        if ($types->getStatusCode() == 200) {
            $response = json_decode($types->getBody()->getContents(), true)['datas'];
        } else {
            $response = [];
        }

        return $response;
    }
}

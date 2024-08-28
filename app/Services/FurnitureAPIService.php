<?php

namespace App\Services;
use GuzzleHttp\Client;

class FurnitureAPIService
{

    public function allProduct($name)
    {
        $client = new Client();
        $all_product = $client->request('GET', config('services.furniture_api.url').'/products?name='.$name);

        if ($all_product->getStatusCode() == 200) {
            $response = json_decode($all_product->getBody()->getContents(), true)['datas'];
        } else {
            $response = [];
        }

        return $response;
    }

    public function oneProduct($limit = 1, $product_name)
    {
        $client = new Client();
        $one_product = $client->request('GET', config('services.furniture_api.url').'/products?limit='.$limit.'&name='.$product_name);

        if ($one_product->getStatusCode() == 200) {
            $response = json_decode($one_product->getBody()->getContents(), true)['datas'][0];
        } else {
            $response = [];
        }

        return $response;
    }


    public function allType()
    {
        $client = new Client();
        $types = $client->request('GET', config('services.furniture_api.url').'/types');

        if ($types->getStatusCode() == 200) {
            $response = json_decode($types->getBody()->getContents(), true)['datas'];
        } else {
            $response = [];
        }

        return $response;
    }
}

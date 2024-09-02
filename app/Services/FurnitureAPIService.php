<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class FurnitureAPIService
{

    public function allProduct(string $name = " ", string $type = " ", int $limit = 20, string $seller = " ")
    {
        $client = new Client();

        $queryParameters = [];

        if ($name) {
            $queryParameters['name'] = $name;
        }

        if ($type) {
            $queryParameters['type'] = $type;
        }
    
        if ($limit) {
            $queryParameters['limit'] = $limit;
        }
    
        if ($seller) {
            $queryParameters['seller'] = $seller;
        }

        $all_product = $client->request('GET', config('services.furniture_api.url') . '/products?'.http_build_query($queryParameters));

        if ($all_product->getStatusCode() == 200) {
            $response = $all_product->getStatusCode();
            $response = json_decode($all_product->getBody()->getContents(), true)['datas'];
        } else {
            $response = [];
        }

        return $response;
    }


    public function allType()
    {
        $client = new Client();
        $types = $client->request('GET', config('services.furniture_api.url') . '/types');

        if ($types->getStatusCode() == 200) {
            $response = json_decode($types->getBody()->getContents(), true)['datas'];
        } else {
            $response = [];
        }

        return $response;
    }

    public function register($datas)
    {
        $client = new Client();
        $response = [];

        try {
            $types = $client->request('POST', config('services.furniture_api.url') . '/register', [
                'json' => [
                    'name' => $datas['name'],
                    'email' => $datas['email'],
                    'password' => $datas['password']
                ]
            ]);

            if ($types->getStatusCode() == 200) {
                $response = json_decode($types->getBody()->getContents(), true);
            }
        } catch (RequestException $e) {
            
            $errorMessage = $e->getMessage();
        }

        return $response;
    }

    public function login($datas)
    {
        $client = new Client();
        $response = [];

        try {
            $types = $client->request('POST', config('services.furniture_api.url') . '/login', [
                'json' => [
                    'email' => $datas['email'],
                    'password' => $datas['password']
                ]
            ]);

            if ($types->getStatusCode() == 200) {
                $response = json_decode($types->getBody()->getContents(), true);
            }
        } catch (RequestException $e) {
            // Handle error if request fails
            $errorMessage = $e->getMessage();
            // You can log the error or handle it as needed
        }

        return $response;
    }

    public function addNewProduct($token, $datas)
    {
        $client = new Client();
        $response = [];

        try {
            $types = $client->request('POST', config('services.furniture_api.url') . '/products', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,  
                    'Accept' => 'application/json',         
                ],
                'json' => [
                    'seller_email' => $datas['seller_email'],
                    'name' => $datas['name'],
                    'type' => $datas['type'],
                    'description' => $datas['description'],
                    'price' => $datas['price'],
                    'img_link' => $datas['img_link'],
                ]
            ]);

            if ($types->getStatusCode() == 200) {
                $response = json_decode($types->getBody()->getContents(), true);
            }
        } catch (RequestException $e) {
            // Handle error if request fails
            $errorMessage = $e->getMessage();
            // You can log the error or handle it as needed
        }

        return $response;
    }
}

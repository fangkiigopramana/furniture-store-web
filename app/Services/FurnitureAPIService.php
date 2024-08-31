<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class FurnitureAPIService
{

    public function allProduct($name)
    {
        $client = new Client();
        $all_product = $client->request('GET', config('services.furniture_api.url') . '/products?name=' . $name);

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
        $one_product = $client->request('GET', config('services.furniture_api.url') . '/products?limit=' . $limit . '&name=' . $product_name);

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
        $types = $client->request('GET', config('services.furniture_api.url') . '/types');

        if ($types->getStatusCode() == 200) {
            $response = json_decode($types->getBody()->getContents(), true)['datas'];
        } else {
            $response = [];
        }

        return $response;
    }

    public function login($email, $password)
    {
        $client = new Client();
        $response = [];

        try {
            $types = $client->request('POST', config('services.furniture_api.url') . '/login', [
                'json' => [
                    'email' => $email,
                    'password' => $password
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

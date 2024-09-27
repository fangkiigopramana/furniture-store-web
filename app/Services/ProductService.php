<?php

namespace App\Services;

use App\Models\Product;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class ProductService
{

    public function allProduct(string $name = "", string $category = "", int $limit = 20, string $seller = "")
    {
        $query = Product::query();
    
        if (!empty($name)) {
            $query->where('name', 'like', "%{$name}%");
        }
    
        if (!empty($category)) {
            $query->where('category', '=', $category);
        }
    
        if (!empty($seller)) {
            $query->where('seller', '=', $seller);
        }
    
        $products = $query->limit($limit)->get();
    
        return $products;
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

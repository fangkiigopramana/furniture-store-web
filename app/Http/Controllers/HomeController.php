<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $client = new Client();
        $best_products = $client->request('GET','https://furni-store.kihub.net/api/products?limit=3');
        $types = $client->request('GET','https://furni-store.kihub.net/api/types');

        if($best_products->getStatusCode() == 200){
            $best_products = json_decode($best_products->getBody()->getContents(), true)['datas'];
        } else {
            $best_products = [];
        }
        
        $types = json_decode($types->getBody()->getContents(), true)['datas'];

        return view('home',compact('best_products','types'));
    }
}

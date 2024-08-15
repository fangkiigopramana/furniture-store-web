<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopController extends Controller
{
    public function index(){
        $client = new Client();
        $products = $client->request('GET','https://furni-store.kihub.net/api/products');
        if($products->getStatusCode() == 200){
            $products = json_decode($products->getBody()->getContents(), true)['datas'];
        } else {
            $products = [];
        }
        return view('shop',compact('products'));
    }
}

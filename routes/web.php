<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/product-catalog',[ShopController::class, 'index'])->name('product_catalog');
Route::get('/search',[ShopController::class, 'search'])->name('products.search');
Route::controller(AuthController::class)->group(function(){
    Route::prefix('login')->name('login.')->group(function () {
        Route::get('/', 'login')->name('index');
        Route::post('/auth', 'authenticate')->name('authenticate');
    });
    
    Route::prefix('register')->name('register.')->group(function () {
        Route::get('/','register')->name('index');
    });
});

Route::view('/frequently-asked-questions','faq')->name('faq');
<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/shop',[ShopController::class, 'index'])->name('shop');
Route::controller(AuthController::class)->group(function(){
    Route::prefix('login')->name('login.')->group(function () {
        Route::get('/', 'login')->name('index');
        Route::post('/auth', 'authenticate')->name('authenticate');
    });
    
    Route::prefix('register')->name('register.')->group(function () {
        Route::get('/','register')->name('index');
    });
});

Route::get('/contoh',function () {
    return 'ini';
})->middleware(['auth']);
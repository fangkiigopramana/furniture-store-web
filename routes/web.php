<?php

use App\Http\Controllers\PaymentController;
use App\Livewire\Cart;
use App\Livewire\FAQ;
use App\Livewire\Home;
use App\Livewire\MyProduct;
use App\Livewire\Order;
use App\Livewire\ProductCatalog;
use App\Livewire\SignIn;
use App\Livewire\SignUp;
use App\Livewire\Transaction;
use Illuminate\Support\Facades\Route;


Route::get('/', Home::class)->name('home');
Route::get('/sign-in', SignIn::class)->name('login')->middleware('guest');
Route::get('/sign-up', SignUp::class)->name('sign-up')->middleware('guest');

Route::middleware('auth')->group(function (){
    Route::middleware(['role:Seller'])->group(function (){
        Route::get('/my-product', MyProduct::class)->name('my-product');
    
    });
    
    Route::middleware(['role:Buyer'])->group(function (){
        Route::get('/product-catalog', ProductCatalog::class)->name('product_catalog');
        Route::get('/faq', FAQ::class)->name('faq');
        Route::get('/cart', Cart::class)->name('cart');
        Route::get('/myorder', Order::class)->name('myorder');
    
    });

    Route::get('/sign-out', [SignIn::class,'signout'])->name('sign-out');

});

Route::get('/coba-midtrans', [PaymentController::class, 'createCharge']);


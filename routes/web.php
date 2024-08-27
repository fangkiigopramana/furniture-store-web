<?php

use App\Livewire\FAQ;
use App\Livewire\Home;
use App\Livewire\ProductCatalog;
use App\Livewire\SignIn;
use App\Livewire\SignUp;
use Illuminate\Support\Facades\Route;


Route::get('/', Home::class)->name('home');
Route::get('/sign-in', SignIn::class)->name('sign-in')->middleware('guest');
Route::get('/sign-out', [SignIn::class,'signout'])->name('sign-out')->middleware('auth');
Route::get('/sign-up', SignUp::class)->name('sign-up')->middleware('guest');

Route::get('/product-catalog',ProductCatalog::class)->name('product_catalog')->middleware('auth');
Route::get('/faq',FAQ::class)->name('faq');

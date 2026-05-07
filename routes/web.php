<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

// welcome page
Route::get('/', [PublicController::class, 'welcome'])->name('welcome'); 

// articolo page
Route::get('/articolo', [PublicController::class, 'article'])->name('article'); 

// log in page
Route::get('/accesso', [PublicController::class, 'login'])->name('login'); 

// products page
Route::get('/prodotti/{category}', [PublicController::class, 'products'])->name('products.index');

// personalizzakatana page
Route::get('/personalizzakatana', [OrderController::class, 'personalizzakatana'])->name('personalizzakatana');

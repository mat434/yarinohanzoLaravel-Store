<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

// welcome page
Route::get('/', [PublicController::class, 'welcome'])->name('welcome'); 

// articolo page
Route::get('/articolo', [PublicController::class, 'article'])->name('article'); 

// products page
Route::get('/prodotti/{category}', [PublicController::class, 'products'])->name('products.index');

// offer page
Route::get('/offerte', [PublicController::class, 'offers'])->name('offers.index');

// personalizzakatana page
Route::get('/personalizzakatana', [OrderController::class, 'personalizzakatana'])->name('personalizzakatana');

Route::post('/personalizzakatana/done', [OrderController::class, 'personalizzakatana_done'])->name('personalizzakatana_done');
// personalizzakatana page end

// pagina registration
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'store'])->name('register.store');

// pagina login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.authenticate');

// pagina logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');   
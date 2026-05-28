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


// pagina login


// pagina logout
   

// Middlware Guest registration
Route::middleware('guest')->group(function () {

    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'store'])->middleware('throttle:5,1')->name('register.store');

        Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->middleware('throttle:5,1'); // Protezione Brute-Force: Max 5 tentativi al minuto->name('login.authenticate');
});

// Middlware Authenticated LogOut
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
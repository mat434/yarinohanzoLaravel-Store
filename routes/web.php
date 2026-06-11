<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

// welcome page
Route::get('/', [PublicController::class, 'welcome'])->name('welcome'); 

// articolo page catalogo normale
Route::get('/prodotto/{id}', [PublicController::class, 'showProduct'])->name('product.show');

// Carrello
Route::post('/carrello/aggiungi', [CartController::class, 'add'])->name('cart.add');
Route::post('/carrello/rimuovi', [CartController::class, 'remove'])->name('cart.remove');

// barra di ricerca
Route::get('/ricerca', [PublicController::class, 'search'])->name('products.search');

// articolo page catalogo offerte
Route::get('/offerta/{id}', [PublicController::class, 'showOffer'])->name('offer.show');

// articolo martial art
// Rotta per le arti marziali dal catalogo normale
Route::get('/arte-marziale/{id}', [PublicController::class, 'showMartialArt'])->name('martialArt.show');


// offer page
Route::get('/offerte', [PublicController::class, 'offers'])->name('offers.index');

// personalizzakatana page
Route::get('/personalizzakatana', [OrderController::class, 'personalizzakatana'])->name('personalizzakatana');

Route::post('/personalizzakatana/done', [OrderController::class, 'personalizzakatana_done'])->name('personalizzakatana_done');
// personalizzakatana page end



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

// logica sidebar
Route::get('/katana/{subcategory?}', function ($subcategory = null) {
    return redirect()->route('products.index', ['category' => 'katana', 'subcategory' => $subcategory]);
});

Route::get('/prodotti/{category}/{subcategory?}', [PublicController::class, 'products'])->name('products.index');
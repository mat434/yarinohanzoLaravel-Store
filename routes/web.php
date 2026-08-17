<?php

use App\Http\Controllers\API\ReviewController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

// welcome page
Route::get('/', [PublicController::class, 'welcome'])->name('welcome'); 

// articolo page catalogo normale
Route::get('/prodotto/{id}', [PublicController::class, 'showProduct'])->name('product.show');

// Carrello
Route::post('/carrello/aggiungi', [CartController::class, 'add'])->name('cart.add');
Route::post('/carrello/rimuovi', [CartController::class, 'remove'])->name('cart.remove');

// Rotta per l'acquisto immediato (aggiunge e reindirizza)
Route::post('/carrello/acquista-ora', [CartController::class, 'buyNow'])->name('cart.buynow');

// Rotte per la pagina di Checkout
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout/conferma', [CheckoutController::class, 'process'])->name('checkout.process');
Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
Route::get('/checkout/cancel', [CheckoutController::class, 'cancel'])->name('checkout.cancel');

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

Route::post('/personalizzakatana/done', [OrderController::class, 'personalizzakatana_done'])->name('personalizzakatana.done');
// personalizzakatana page end

// recensioni
// Rotte pubbliche 
Route::get('/reviews/latest', [ReviewController::class, 'getLatestReviews']);
Route::get('/products/{productId}/reviews', [ReviewController::class, 'getProductReviews']);
Route::get('/api/latest-reviews', [ReviewController::class, 'getLatestReviews']);




// Middlware Guest registration
Route::middleware('guest')->group(function () {

// Recupero password
    Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->middleware('throttle:5,1')->name('password.email');
    Route::get('/reset-password/{token}', [AuthController::class, 'showResetPassword'])->name('password.reset');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'store'])->middleware('throttle:5,1')->name('register.store');

        Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->middleware('throttle:5,1'); // Protezione Brute-Force: Max 5 tentativi al minuto->name('login.authenticate');
});

// Middlware Authenticated LogOut
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Nuova rotta per l'area personale dell'utente
    Route::get('/area-personale', [UserController::class, 'index'])->name('user.profile');
});

// Middleware Verifica Email
Route::middleware('auth')->group(function () {
    // Pagina "controlla la tua email"
    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->name('verification.notice');

    // Link che arriva via email (firmato, con ID utente e hash)
    Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verifyEmail'])
        ->middleware('signed')
        ->name('verification.verify');

    // Pulsante "rinvia email di verifica"
    Route::post('/email/verification-notification', [AuthController::class, 'resendVerification'])
        ->middleware('throttle:6,1')
        ->name('verification.send');
});



Route::middleware(['auth', 'verified'])->prefix('api')->group(function () {
    Route::post('/reviews', [App\Http\Controllers\API\ReviewController::class, 'store']);
});
// fine rotta recensioni


// logica sidebar
Route::get('/katana/{subcategory?}', function ($subcategory = null) {
    return redirect()->route('products.index', ['category' => 'katana', 'subcategory' => $subcategory]);
});

Route::get('/prodotti/{category}/{subcategory?}', [PublicController::class, 'products'])->name('products.index');

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
// welcome page
Route::get('/', function () {
    return view('welcome');
});

// articolo page
Route::get('/articolo', function () {
    return view('article');
}); // Pagina articolo

// offerte page
Route::get('/offerte', function () {
    return view('offers');
}); // Pagina offerte

// log in page
Route::get('/accesso', function () {
    return view('Login');
}); // Pagina accesso

Route::get('/prodotti', [ProductController::class, 'allProducts']); // Pagina prodotti



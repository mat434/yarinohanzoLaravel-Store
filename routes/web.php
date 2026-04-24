<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [ProductController::class, 'index']); // La tua Home
Route::get('/prodotti', [ProductController::class, 'allProducts']); // Pagina prodotti



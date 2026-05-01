<?php

use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;
// welcome page
Route::get('/', [PublicController::class, 'welcome'])->name('welcome'); // Pagina di benvenuto

// articolo page
Route::get('/articolo', [PublicController::class, 'article'])->name('article'); // Pagina articolo

// log in page
Route::get('/accesso', [PublicController::class, 'login'])->name('login'); // Pagina accesso

// products page
Route::get('/prodotti/{category}', [PublicController::class, 'products'])->name('products.index');




<?php

use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;
// welcome page
Route::get('/', [PublicController::class, 'welcome'])->name('welcome'); // Pagina di benvenuto

// articolo page
Route::get('/articolo', [PublicController::class, 'article'])->name('article'); // Pagina articolo

// offerte page
Route::get('/offerte', [PublicController::class, 'offers'])->name('offers'); // Pagina offerte

// log in page
Route::get('/accesso', [PublicController::class, 'login'])->name('login'); // Pagina accesso





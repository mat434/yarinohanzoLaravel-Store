<?php

namespace App\Http\Controllers;

// Usiamo il percorso completo così non sbagliamo
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return view('welcome');
    }
}
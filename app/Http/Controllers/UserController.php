<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CustomKatana; // Importiamo il modello dallo screenshot

class UserController extends Controller
{
    public function index()
    {
        // Recuperiamo l'utente autenticato
        $user = Auth::user();

        // Recuperiamo le recensioni scritte da questo utente
        $reviews = $user->reviews()->latest()->get();

        // Recuperiamo le katane personalizzate ordinate dall'utente usando la sua email
        $customKatanas = CustomKatana::where('user_id', $user->id)->latest()->get();

        // Passiamo tutti i dati reali alla vista
        return view('user.profile', compact('user', 'reviews', 'customKatanas'));
    }
}
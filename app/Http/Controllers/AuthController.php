<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        // Validazione dei dati di registrazione
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'string', Password::min(8)->mixedCase()->numbers()->symbols(), 'confirmed'],
        ]);

        // Creazione dell'utente
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Log in automatico dopo la registrazione
        Auth::login($user);

        return redirect('/')->with('success', 'Account creato con successo!');
    }

    public function showLogin() {
        return view('auth.login');
    }
    // Gestisce l'accesso
    public function authenticate(Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Tenta di autenticare l'utente
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // Protezione contro attacchi session fixation

            return redirect()->intended('/')->with('success', 'Bentornato!');
        }

        return back()->withErrors([
            'email' => 'Le credenziali non corrispondono ai nostri record.',
        ]);
    }

    // Logout
    public function Logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regeneratetoken();

        return redirect('/')->with('success', 'Sei stato disconnesso con successo!');

    }
}

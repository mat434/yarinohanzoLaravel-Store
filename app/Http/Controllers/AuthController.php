<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Password as PasswordBroker;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'string', Password::min(8)->mixedCase()->numbers()->symbols(), 'confirmed'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect('/')->with('success', 'Account creato con successo!');
    }

    public function showLogin() {
        return view('auth.login');
    }

    public function authenticate(Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/')->with('success', 'Bentornato!');
        }

        return back()->withErrors([
            'email' => 'Le credenziali non corrispondono ai nostri record.',
        ]);
    }

    public function Logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regeneratetoken();

        return redirect('/')->with('success', 'Sei stato disconnesso con successo!');
    }

    // Mostra il form "inserisci la tua email"
    public function showForgotPassword()
    {
        return view('auth.forgot-password');
    }

    // Invia l'email con il link di reset
    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = PasswordBroker::sendResetLink(
            $request->only('email')
        );

        return $status === PasswordBroker::RESET_LINK_SENT
            ? back()->with('success', 'Ti abbiamo inviato un link per reimpostare la password.')
            : back()->withErrors(['email' => 'Non riusciamo a trovare un utente con questa email.']);
    }

    // Mostra il form "inserisci nuova password"
    public function showResetPassword(Request $request, $token)
    {
        return view('auth.reset-password', [
            'token' => $token,
            'email' => $request->email,
        ]);
    }

    // Salva la nuova password
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => ['required', 'string', Password::min(8)->mixedCase()->numbers()->symbols(), 'confirmed'],
        ]);

        $status = PasswordBroker::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->save();
            }
        );

        return $status === PasswordBroker::PASSWORD_RESET
            ? redirect()->route('login')->with('success', 'Password reimpostata con successo! Ora puoi accedere.')
            : back()->withErrors(['email' => 'Il link non è valido o è scaduto.']);
    }
}
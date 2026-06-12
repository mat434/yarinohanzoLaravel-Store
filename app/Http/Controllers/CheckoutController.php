<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomKatana;
use App\Mail\CustomKatanaOrder;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);
        $customKatana = session('custom_katana'); // Recuperiamo la katana personalizzata
        
        // MODIFICA: Se sia il carrello standard CHE la katana su misura sono vuoti, allora reindirizza
        if (empty($cart) && !$customKatana) {
            return redirect()->to('/')->with('message', 'Il carrello è vuoto.');
        }

        $totalPrice = 0;

        // Calcoliamo il prezzo degli oggetti standard (se presenti)
        if (!empty($cart)) {
            $totalPrice += array_reduce($cart, function ($carry, $item) {
                return $carry + $item['prezzo'] * $item['quantity'];
            }, 0);
        }

        // MODIFICA: Se c'è una katana personalizzata, aggiungiamo il suo prezzo al totale
        if ($customKatana) {
            $totalPrice += $customKatana['prezzo'];
        }

        // Passiamo anche $customKatana alla vista del checkout
        return view('checkout', compact('cart', 'customKatana', 'totalPrice'));
    }

    public function process(Request $request)
    {
        // Qui convalidi i dati (Nome, Indirizzo, Metodo scelto)
        $request->validate([
            'nome' => 'required|string|max:255',
            'indirizzo' => 'required|string',
            'metodo_pagamento' => 'required'
        ]);

        // === LOGICA PER LA KATANA PERSONALIZZATA ===
        // Se l'utente ha configurato una katana, la salviamo sul DB e inviamo l'email ORA che ha premuto "Acquista"
        if (session()->has('custom_katana')) {
            $katanaSession = session('custom_katana');
            $dataForDb = $katanaSession['info'];

            // Adattiamo la chiave del nome per il Database (da katana_name a name)
            $dataForDb['name'] = $dataForDb['katana_name'];
            unset($dataForDb['katana_name']);

            // 1. Salviamo sul Database
            $customKatana = CustomKatana::create($dataForDb);

            // 2. Inviamo l'email ufficiale al Maestro Forgiatore con i dati del DB
            Mail::to('yarinohanzokatana@mail.com')->send(new CustomKatanaOrder($customKatana));

            // 3. Svuotiamo la sessione della katana
            session()->forget('custom_katana');
        }

        // Svuotiamo anche il carrello standard
        session()->forget('cart');

        return redirect()->to('/')->with('success', 'Ordine completato con successo! Il progetto della tua Katana è stato inviato alla fucina.');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{

public function buyNow(Request $request)
{
    $cart = session()->get('cart', []);
    $key = $request->type . '_' . $request->id;
    
    if (isset($cart[$key])) {
        $cart[$key]['quantity']++;
    } else {
        $cart[$key] = [
            "nome" => $request->nome,
            "quantity" => 1,
            "prezzo" => $request->prezzo,
            "img" => $request->img
        ];
    }
    session()->put('cart', $cart);

    return redirect()->route('checkout.index');
}


    // Aggiunge un prodotto al carrello
    public function add(Request $request)
    {
        // Recuperiamo il carrello dalla sessione (se non c'è, creiamo un array vuoto)
        $cart = session()->get('cart', []);

        // Creiamo una chiave unica per il prodotto (es. "katana_15" o "martial_3")
        $cartKey = $request->type . '_' . $request->id;

        // Se il prodotto c'è già, aumentiamo la quantità
        if (isset($cart[$cartKey])) {
            $cart[$cartKey]['quantity']++;
        } else {
            // Altrimenti lo aggiungiamo nuovo
            $cart[$cartKey] = [
                'id' => $request->id,
                'type' => $request->type,
                'nome' => $request->nome,
                'prezzo' => $request->prezzo,
                'img' => $request->img,
                'quantity' => 1
            ];
        }

        // Salviamo il carrello aggiornato in sessione
        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Prodotto aggiunto al carrello!');
    }

    // Rimuove un prodotto dal carrello
    public function remove(Request $request)
    {
        if ($request->cartKey) {
            $cart = session()->get('cart');
            if (isset($cart[$request->cartKey])) {
                unset($cart[$request->cartKey]);
                session()->put('cart', $cart);
            }
        }
        return redirect()->back()->with('success', 'Prodotto rimosso!');
    }
}

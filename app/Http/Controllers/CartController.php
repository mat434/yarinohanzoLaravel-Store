<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductKatanas;
use App\Models\MartialArts;
use App\Models\Offers;

class CartController extends Controller
{
    // Recupera i dati REALI del prodotto dal database, ignorando qualsiasi cosa arrivi dal client
    private function getProdottoReale(Request $request)
    {
        // Se c'è un offer_id, il prezzo va recuperato tramite l'offerta
        if ($request->offer_id) {
            $offer = Offers::find($request->offer_id);

            if (!$offer) {
                return null;
            }

            if ($offer->katana_id) {
                $katana = $offer->katana;
                return [
                    'nome' => $katana->nome,
                    'prezzo' => $offer->prezzo_scontato ?? $katana->prezzo,
                    'img' => $katana->img,
                    'type' => 'katana',
                ];
            }

            if ($offer->martial_art_id) {
                $martial = $offer->martialArt;
                return [
                    'nome' => $martial->nome,
                    'prezzo' => $offer->prezzo_scontato ?? $martial->prezzo,
                    'img' => $martial->img,
                    'type' => 'martial',
                ];
            }

            // Offerta "diretta" (non collegata a katana/arte marziale)
            return [
                'nome' => $offer->nome,
                'prezzo' => $offer->prezzo,
                'img' => $offer->img,
                'type' => 'offer',
            ];
        }

        // Nessuna offerta: prodotto normale, cerchiamo nella tabella giusta in base al type
        if ($request->type === 'martial') {
            $product = MartialArts::find($request->id);
        } else {
            $product = ProductKatanas::find($request->id);
        }

        if (!$product) {
            return null;
        }

        return [
            'nome' => $product->nome,
            'prezzo' => $product->prezzo,
            'img' => $product->img,
            'type' => $request->type,
        ];
    }

    public function buyNow(Request $request)
    {
        $prodotto = $this->getProdottoReale($request);

        if (!$prodotto) {
            return redirect()->back()->with('message', 'Prodotto non trovato.');
        }

        $cart = session()->get('cart', []);
        $key = $prodotto['type'] . '_' . $request->id . ($request->offer_id ? '_offer' . $request->offer_id : '');

        if (isset($cart[$key])) {
            $cart[$key]['quantity']++;
        } else {
            $cart[$key] = [
                'nome' => $prodotto['nome'],
                'quantity' => 1,
                'prezzo' => $prodotto['prezzo'],
                'img' => $prodotto['img'],
            ];
        }
        session()->put('cart', $cart);

        return redirect()->route('checkout.index');
    }

    public function add(Request $request)
    {
        $prodotto = $this->getProdottoReale($request);

        if (!$prodotto) {
            return redirect()->back()->with('message', 'Prodotto non trovato.');
        }

        $cart = session()->get('cart', []);
        $cartKey = $prodotto['type'] . '_' . $request->id . ($request->offer_id ? '_offer' . $request->offer_id : '');

        if (isset($cart[$cartKey])) {
            $cart[$cartKey]['quantity']++;
        } else {
            $cart[$cartKey] = [
                'id' => $request->id,
                'type' => $prodotto['type'],
                'nome' => $prodotto['nome'],
                'prezzo' => $prodotto['prezzo'],
                'img' => $prodotto['img'],
                'quantity' => 1
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Prodotto aggiunto al carrello!');
    }

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
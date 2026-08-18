<?php

namespace App\Http\Controllers;

use App\Mail\OrderConfirmation;
use Illuminate\Http\Request;
use App\Models\CustomKatana;
use App\Mail\CustomKatanaOrder;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
use Stripe\StripeClient;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);
        $customKatana = session('custom_katana');

        if (empty($cart) && !$customKatana) {
            return redirect()->to('/')->with('message', 'Il carrello è vuoto.');
        }

        $totalPrice = 0;

        if (!empty($cart)) {
            $totalPrice += array_reduce($cart, function ($carry, $item) {
                return $carry + $item['prezzo'] * $item['quantity'];
            }, 0);
        }

        if ($customKatana) {
            $totalPrice += $customKatana['prezzo'];
        }

        return view('checkout', compact('cart', 'customKatana', 'totalPrice'));
    }

    // STEP 1: valida i dati e crea la sessione di pagamento Stripe
    public function process(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email',
            'indirizzo' => 'required|string',
        ]);

        // Ricalcoliamo il totale qui, lato server, per sicurezza (non ci fidiamo di nulla dal client)
        $cart = session('cart', []);
        $customKatana = session('custom_katana');

        if (empty($cart) && !$customKatana) {
            return redirect()->to('/')->with('message', 'Il carrello è vuoto.');
        }

        $totalPrice = 0;
        if (!empty($cart)) {
            $totalPrice += array_reduce($cart, function ($carry, $item) {
                return $carry + $item['prezzo'] * $item['quantity'];
            }, 0);
        }
        if ($customKatana) {
            $totalPrice += $customKatana['prezzo'];
        }

        // Salviamo nome, email e indirizzo in sessione: ci serviranno dopo, quando Stripe conferma il pagamento
        session([
            'checkout_info' => [
                'nome' => $request->nome,
                'email' => $request->email,
                'indirizzo' => $request->indirizzo,
            ]
        ]);

        $stripe = new StripeClient(config('services.stripe.secret'));

        $checkoutSession = $stripe->checkout->sessions->create([
            'payment_method_types' => ['card'],
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'eur',
                        'product_data' => [
                            'name' => $customKatana ? 'Katana Personalizzata' : 'Ordine YariNoHanzo',
                        ],
                        // Stripe vuole il prezzo in centesimi, non in euro
                        'unit_amount' => (int) round($totalPrice * 100),
                    ],
                    'quantity' => 1,
                ]
            ],
            'mode' => 'payment',
            'success_url' => route('checkout.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('checkout.cancel'),
        ]);

        return redirect()->away($checkoutSession->url);
    }

    // STEP 2: Stripe rimanda qui l'utente dopo un pagamento riuscito
    public function success(Request $request)
    {
        $sessionId = $request->query('session_id');

        if (!$sessionId) {
            return redirect()->to('/')->with('message', 'Sessione di pagamento non valida.');
        }

        // === PROTEZIONE ANTI-DOPPIA ESECUZIONE ===
        // Se questo session_id è già stato processato (refresh, doppio tab, retry del browser),
        // mostriamo subito il messaggio di successo senza rieseguire nulla.
        $cacheKey = 'stripe_session_processed_' . $sessionId;

        if (Cache::has($cacheKey)) {
            return redirect()->to('/')->with('success', 'Pagamento completato! Il progetto della tua Katana è stato inviato alla fucina.');
        }

        $stripe = new StripeClient(config('services.stripe.secret'));

        $checkoutSession = $stripe->checkout->sessions->retrieve($sessionId);

        // Verifica REALE col server Stripe, non ci fidiamo del semplice arrivo su questa pagina
        if ($checkoutSession->payment_status !== 'paid') {
            return redirect()->to('/checkout')->with('message', 'Il pagamento non è andato a buon fine. Riprova.');
        }

        // Segniamo subito questo session_id come "in lavorazione/processato", prima di fare qualunque cosa.
        // Così anche richieste concorrenti quasi simultanee trovano già il blocco.
        Cache::put($cacheKey, true, now()->addHours(24));

        $checkoutInfo = session('checkout_info', []);

        // Ricalcoliamo cart e totalPrice qui, prima che vengano puliti dalla sessione
        $cart = session('cart', []);
        $totalPrice = 0;
        if (!empty($cart)) {
            $totalPrice += array_reduce($cart, function ($carry, $item) {
                return $carry + $item['prezzo'] * $item['quantity'];
            }, 0);
        }
        if (session('custom_katana')) {
            $totalPrice += session('custom_katana')['prezzo'];
        }

        $katanaSession = null;

        // === LOGICA PER LA KATANA PERSONALIZZATA (finalizzata solo dopo pagamento confermato) ===
        if (session()->has('custom_katana')) {
            $katanaSession = session('custom_katana');
            $dataForDb = $katanaSession['info'];

            $dataForDb['name'] = $dataForDb['katana_name'];
            unset($dataForDb['katana_name']);
            $dataForDb['user_id'] = auth()->id();

            $customKatana = CustomKatana::create($dataForDb);

            // Invio email al forgiatore (non bloccante: se fallisce, l'ordine resta comunque valido)

            try {
                Mail::to('yarinohanzokatana@mail.com')->send(new CustomKatanaOrder($customKatana));
            } catch (\Exception $e) {
                \Log::error('Invio email al forgiatore fallito: ' . $e->getMessage());
            }

            sleep(20); // Pausa di 20 secondi per rispettare il limite di Mailtrap in modalità test

            session()->forget('custom_katana');
        }

        // Invio email di conferma al cliente (non bloccante: se fallisce, l'ordine resta comunque valido)
        if (!empty($checkoutInfo['email'])) {
            try {
                Mail::to($checkoutInfo['email'])->send(new OrderConfirmation(
                    $checkoutInfo['nome'],
                    $checkoutInfo['indirizzo'],
                    $totalPrice,
                    $katanaSession,
                    $cart
                ));
            } catch (\Exception $e) {
                \Log::error('Invio email conferma ordine fallito: ' . $e->getMessage());
            }
        }

        session()->forget('cart');
        session()->forget('checkout_info');

        return redirect()->to('/')->with('success', 'Pagamento completato! Il progetto della tua Katana è stato inviato alla fucina.');
    }

    // Stripe rimanda qui se l'utente annulla il pagamento
    public function cancel()
    {
        return redirect()->to('/checkout')->with('message', 'Pagamento annullato. Il tuo ordine è ancora nel carrello.');
    }
}
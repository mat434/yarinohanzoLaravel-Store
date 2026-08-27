<?php

namespace App\Http\Controllers;

use App\Mail\OrderConfirmation;
use App\Models\CustomKatana;
use App\Models\Order;
use App\Mail\CustomKatanaOrder;
use Illuminate\Http\Request;
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

        // Totale del SOLO carrello standard (senza katana personalizzata): è questo che salviamo nell'Order
        $cartTotal = 0;
        if (!empty($cart)) {
            $cartTotal = array_reduce($cart, function ($carry, $item) {
                return $carry + $item['prezzo'] * $item['quantity'];
            }, 0);
        }

        // Totale complessivo (carrello + eventuale katana), usato solo per l'email di conferma
        $totalPrice = $cartTotal;
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

            // Accodiamo l'email al forgiatore: verrà inviata in background dal queue worker
            Mail::to('yarinohanzokatana@mail.com')->queue(new CustomKatanaOrder($customKatana));

            session()->forget('custom_katana');
        }

        // === SALVATAGGIO DELL'ORDINE STANDARD (solo se c'è un carrello, non per le katane personalizzate) ===
        if (!empty($cart)) {
            $order = Order::create([
                'user_id'            => auth()->id(),
                'nome'               => $checkoutInfo['nome'] ?? '',
                'email'              => $checkoutInfo['email'] ?? '',
                'indirizzo'          => $checkoutInfo['indirizzo'] ?? '',
                'total_price'        => $cartTotal,
                'stripe_session_id'  => $sessionId,
                'status'             => 'in_lavorazione',
            ]);

            foreach ($cart as $item) {
                $order->items()->create([
                    'nome'     => $item['nome'],
                    'prezzo'   => $item['prezzo'],
                    'quantity' => $item['quantity'],
                    'img'      => $item['img'] ?? null,
                    'type'     => $item['type'] ?? null,
                ]);
            }
        }

        // Accodiamo l'email di conferma al cliente, con un ritardo rispetto alla prima
        // per restare sotto il rate limit di Mailtrap in modalità test.
        // Questo blocco va SEMPRE eseguito, sia con katana personalizzata che con carrello standard.
        if (!empty($checkoutInfo['email'])) {
            Mail::to($checkoutInfo['email'])->later(
                now()->addSeconds(25),
                new OrderConfirmation($checkoutInfo['nome'], $checkoutInfo['indirizzo'], $totalPrice, $katanaSession, $cart)
            );
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
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
    // Costo fisso della spedizione Express, gratuita sopra questa soglia di spesa
    private const EXPRESS_COST = 9.90;
    private const FREE_EXPRESS_THRESHOLD = 50;

    // Calcola il costo di spedizione SEMPRE lato server, mai fidandosi del client
    private function calculateShippingCost(string $shippingType, float $subtotal): float
    {
        if ($shippingType === 'express') {
            return $subtotal > self::FREE_EXPRESS_THRESHOLD ? 0 : self::EXPRESS_COST;
        }

        return 0; // Standard è sempre gratuita
    }

    public function index()
    {
        $cart = session('cart', []);
        $customKatana = session('custom_katana');

        if (empty($cart) && !$customKatana) {
            return redirect()->to('/')->with('message', 'Il carrello è vuoto.');
        }

        $subtotal = 0;

        if (!empty($cart)) {
            $subtotal += array_reduce($cart, function ($carry, $item) {
                return $carry + $item['prezzo'] * $item['quantity'];
            }, 0);
        }

        if ($customKatana) {
            $subtotal += $customKatana['prezzo'];
        }

        // Calcoliamo il costo dell'Express solo per mostrarlo nell'interfaccia (verrà comunque ricalcolato al process())
        $expressCost = $this->calculateShippingCost('express', $subtotal);
        $totalPrice = $subtotal;

        return view('checkout', compact('cart', 'customKatana', 'totalPrice', 'subtotal', 'expressCost'));
    }

    // STEP 1: valida i dati e crea la sessione di pagamento Stripe
    public function process(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email',
            'indirizzo' => 'required|string',
            'shipping_type' => 'required|string|in:standard,express',
        ]);

        // Ricalcoliamo il totale qui, lato server, per sicurezza (non ci fidiamo di nulla dal client)
        $cart = session('cart', []);
        $customKatana = session('custom_katana');

        if (empty($cart) && !$customKatana) {
            return redirect()->to('/')->with('message', 'Il carrello è vuoto.');
        }

        $subtotal = 0;
        if (!empty($cart)) {
            $subtotal += array_reduce($cart, function ($carry, $item) {
                return $carry + $item['prezzo'] * $item['quantity'];
            }, 0);
        }
        if ($customKatana) {
            $subtotal += $customKatana['prezzo'];
        }

        $shippingCost = $this->calculateShippingCost($request->shipping_type, $subtotal);
        $totalPrice = $subtotal + $shippingCost;

        // Salviamo nome, email, indirizzo e spedizione in sessione: ci serviranno dopo, quando Stripe conferma il pagamento
        session([
            'checkout_info' => [
                'nome' => $request->nome,
                'email' => $request->email,
                'indirizzo' => $request->indirizzo,
                'shipping_type' => $request->shipping_type,
                'shipping_cost' => $shippingCost,
            ]
        ]);

        $stripe = new StripeClient(config('services.stripe.secret'));

        $lineItems = [
            [
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => $customKatana ? 'Katana Personalizzata' : 'Ordine YariNoHanzo',
                    ],
                    'unit_amount' => (int) round($subtotal * 100),
                ],
                'quantity' => 1,
            ],
        ];

        // Aggiungiamo la spedizione come riga separata solo se ha un costo (Express sotto soglia)
        if ($shippingCost > 0) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => 'Spedizione Express',
                    ],
                    'unit_amount' => (int) round($shippingCost * 100),
                ],
                'quantity' => 1,
            ];
        }

        $checkoutSession = $stripe->checkout->sessions->create([
            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
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
        $cacheKey = 'stripe_session_processed_' . $sessionId;

        if (Cache::has($cacheKey)) {
            return redirect()->to('/')->with('success', 'Pagamento completato! Il progetto della tua Katana è stato inviato alla fucina.');
        }

        $stripe = new StripeClient(config('services.stripe.secret'));

        $checkoutSession = $stripe->checkout->sessions->retrieve($sessionId);

        if ($checkoutSession->payment_status !== 'paid') {
            return redirect()->to('/checkout')->with('message', 'Il pagamento non è andato a buon fine. Riprova.');
        }

        Cache::put($cacheKey, true, now()->addHours(24));

        $checkoutInfo = session('checkout_info', []);
        $shippingCost = $checkoutInfo['shipping_cost'] ?? 0;
        $shippingType = $checkoutInfo['shipping_type'] ?? 'standard';

        // Totale del SOLO carrello standard (senza katana personalizzata), usato per l'Order salvato nel DB
        $cart = session('cart', []);
        $cartSubtotal = 0;
        if (!empty($cart)) {
            $cartSubtotal = array_reduce($cart, function ($carry, $item) {
                return $carry + $item['prezzo'] * $item['quantity'];
            }, 0);
        }

        // Totale complessivo (carrello + eventuale katana + spedizione), usato per l'email di conferma
        $totalPrice = $cartSubtotal + $shippingCost;
        if (session('custom_katana')) {
            $totalPrice += session('custom_katana')['prezzo'];
        }

        $katanaSession = null;

        // === LOGICA PER LA KATANA PERSONALIZZATA ===
        if (session()->has('custom_katana')) {
            $katanaSession = session('custom_katana');
            $dataForDb = $katanaSession['info'];

            $dataForDb['name'] = $dataForDb['katana_name'];
            unset($dataForDb['katana_name']);
            $dataForDb['user_id'] = auth()->id();

            $customKatana = CustomKatana::create($dataForDb);

            Mail::to('yarinohanzokatana@mail.com')->queue(new CustomKatanaOrder($customKatana));

            session()->forget('custom_katana');
        }

        // === SALVATAGGIO DELL'ORDINE STANDARD (solo se c'è un carrello) ===
        if (!empty($cart)) {
            $order = Order::create([
                'user_id'            => auth()->id(),
                'nome'               => $checkoutInfo['nome'] ?? '',
                'email'              => $checkoutInfo['email'] ?? '',
                'indirizzo'          => $checkoutInfo['indirizzo'] ?? '',
                'total_price'        => $cartSubtotal + $shippingCost,
                'shipping_type'      => $shippingType,
                'shipping_cost'      => $shippingCost,
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

        // Accodiamo l'email di conferma al cliente
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

    public function cancel()
    {
        return redirect()->to('/checkout')->with('message', 'Pagamento annullato. Il tuo ordine è ancora nel carrello.');
    }
}
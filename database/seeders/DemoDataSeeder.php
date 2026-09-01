<?php

namespace Database\Seeders;

use App\Models\MartialArts;
use App\Models\Offers;
use App\Models\Order;
use App\Models\ProductKatanas;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoDataSeeder extends Seeder
{
    /**
     * Popola il database con utenti, recensioni e ordini realistici per la demo.
     * Va lanciato DOPO SubcategorySeeder / ProductKatanaSeeder / ProductArtialMartsSeeder / ProductOffersSeeder,
     * perché ha bisogno che i prodotti esistano già.
     */
    public function run(): void
    {
        // 1. Utenti demo con nomi italiani credibili
        $clienti = [
            ['name' => 'Marco Bianchi', 'email' => 'marco.bianchi@example.com'],
            ['name' => 'Giulia Ferrari', 'email' => 'giulia.ferrari@example.com'],
            ['name' => 'Alessandro Romano', 'email' => 'alessandro.romano@example.com'],
            ['name' => 'Sara Colombo', 'email' => 'sara.colombo@example.com'],
            ['name' => 'Davide Ricci', 'email' => 'davide.ricci@example.com'],
        ];

        $users = collect($clienti)->map(function ($cliente) {
            return User::firstOrCreate(
                ['email' => $cliente['email']],
                [
                    'name' => $cliente['name'],
                    'password' => Hash::make('password'),
                    'email_verified_at' => now(),
                ]
            );
        });

        // 2. Recensioni realistiche sui prodotti già seedati
        $katane = ProductKatanas::inRandomOrder()->take(6)->get();
        $martialArts = MartialArts::inRandomOrder()->take(4)->get();
        $offerte = Offers::inRandomOrder()->take(2)->get();

        $commentiKatana = [
            ['rating' => 5, 'comment' => 'Equilibrio perfetto, la lama taglia in modo pulito. Consegna rapida e imballo curato.'],
            ['rating' => 5, 'comment' => 'Qualità superiore alle aspettative, si sente che è lavorata bene. Consigliatissima.'],
            ['rating' => 4, 'comment' => 'Ottima katana, l\'unica pecca è che la saya arriva con un leggero odore di vernice che sparisce in un paio di giorni.'],
            ['rating' => 5, 'comment' => 'La uso per iaido da mesi, tiene benissimo l\'affilatura. Tornerò a comprare da YariNoHanzo.'],
            ['rating' => 4, 'comment' => 'Bellissima esteticamente, il tsuka è comodo anche per sessioni lunghe di allenamento.'],
        ];

        $commentiMartial = [
            ['rating' => 5, 'comment' => 'Materiale robusto, resiste bene agli allenamenti intensi. Ottimo rapporto qualità prezzo.'],
            ['rating' => 4, 'comment' => 'Buon prodotto, taglia leggermente più stretta rispetto alla tabella misure.'],
            ['rating' => 5, 'comment' => 'Esattamente come descritto, spedizione veloce e prodotto ben confezionato.'],
        ];

        foreach ($katane as $i => $katana) {
            $c = $commentiKatana[$i % count($commentiKatana)];
            Review::firstOrCreate(
                [
                    'user_id' => $users[$i % $users->count()]->id,
                    'reviewable_id' => $katana->id,
                    'reviewable_type' => 'katana',
                ],
                ['rating' => $c['rating'], 'comment' => $c['comment']]
            );
        }

        foreach ($martialArts as $i => $art) {
            $c = $commentiMartial[$i % count($commentiMartial)];
            Review::firstOrCreate(
                [
                    'user_id' => $users[($i + 2) % $users->count()]->id,
                    'reviewable_id' => $art->id,
                    'reviewable_type' => 'martial',
                ],
                ['rating' => $c['rating'], 'comment' => $c['comment']]
            );
        }

        foreach ($offerte as $i => $offerta) {
            Review::firstOrCreate(
                [
                    'user_id' => $users[($i + 1) % $users->count()]->id,
                    'reviewable_id' => $offerta->id,
                    'reviewable_type' => 'offer',
                ],
                ['rating' => 5, 'comment' => 'Ottimo affare, prodotto identico alla versione a prezzo pieno. Molto soddisfatto.']
            );
        }

        // 3. Ordini realistici, ognuno con 1-3 articoli, distribuiti negli ultimi giorni
        $indirizzi = [
            'Via Roma 12, 20121 Milano (MI)',
            'Corso Vittorio Emanuele 45, 10121 Torino (TO)',
            'Via dei Mille 8, 80121 Napoli (NA)',
            'Piazza Duomo 3, 50122 Firenze (FI)',
            'Via Garibaldi 21, 40124 Bologna (BO)',
        ];

        $tuttiProdotti = $katane->concat($martialArts);

        foreach ($users as $i => $user) {
            $numArticoli = rand(1, 3);
            $articoliOrdine = $tuttiProdotti->random(min($numArticoli, $tuttiProdotti->count()));

            $subtotal = $articoliOrdine->sum('prezzo');
            $shippingType = rand(0, 1) ? 'express' : 'standard';
            $shippingCost = ($shippingType === 'express' && $subtotal <= 50) ? 9.90 : 0;

            $order = Order::create([
                'user_id' => $user->id,
                'nome' => $user->name,
                'email' => $user->email,
                'indirizzo' => $indirizzi[$i % count($indirizzi)],
                'total_price' => $subtotal + $shippingCost,
                'shipping_type' => $shippingType,
                'shipping_cost' => $shippingCost,
                'stripe_session_id' => 'demo_seed_' . uniqid(),
                'status' => 'in_lavorazione',
                'created_at' => now()->subDays(rand(1, 10)),
                'updated_at' => now(),
            ]);

            foreach ($articoliOrdine as $prodotto) {
                $order->items()->create([
                    'nome' => $prodotto->nome,
                    'prezzo' => $prodotto->prezzo,
                    'quantity' => 1,
                    'img' => $prodotto->img,
                    'type' => $prodotto instanceof ProductKatanas ? 'katana' : 'martial',
                ]);
            }

            // Salviamo il primo ordine di alcuni utenti per creare richieste di reso demo dopo il ciclo
            if ($i === 0) {
                $ordinePerResoDomicilio = $order;
            }
            if ($i === 1) {
                $ordinePerResoPostale = $order;
            }
        }

        // 4. Un paio di richieste di reso già pronte, per non mostrare il pannello admin vuoto
        if (isset($ordinePerResoDomicilio) && $ordinePerResoDomicilio->items->isNotEmpty()) {
            $primoArticolo = $ordinePerResoDomicilio->items->first();

            $reso1 = $ordinePerResoDomicilio->returns()->create([
                'user_id' => $ordinePerResoDomicilio->user_id,
                'return_method' => 'domicilio',
                'motivo' => 'Il prodotto non corrisponde esattamente a quanto mi aspettavo, vorrei valutare un cambio.',
                'status' => 'richiesto',
            ]);

            $reso1->items()->create([
                'order_item_id' => $primoArticolo->id,
                'quantity' => 1,
            ]);
        }

        if (isset($ordinePerResoPostale) && $ordinePerResoPostale->items->isNotEmpty()) {
            $primoArticolo = $ordinePerResoPostale->items->first();

            $reso2 = $ordinePerResoPostale->returns()->create([
                'user_id' => $ordinePerResoPostale->user_id,
                'return_method' => 'punto_postale',
                'motivo' => 'Articolo arrivato con un difetto estetico sulla confezione.',
                'status' => 'in_lavorazione',
            ]);

            $reso2->items()->create([
                'order_item_id' => $primoArticolo->id,
                'quantity' => 1,
            ]);
        }
    }
}
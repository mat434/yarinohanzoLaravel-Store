<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Salva una nuova recensione nel database.
     */
    public function store(Request $request)
    {
        // 1. Validazione
        $request->validate([
            'reviewable_id'   => 'required|integer',
            'reviewable_type' => 'required|string|in:katana,martial,martial_arts,offer',
            'rating'          => 'required|integer|min:1|max:5',
            'comment'         => 'nullable|string|max:1000',
        ]);

        // 2. Recuperiamo l'ID utente dalla sessione
        $userId = Auth::id();

        if (!$userId) {
            return response()->json(['message' => 'Utente non autenticato.'], 401);
        }

        // 3. Mappiamo il tipo stringa nel nome effettivo della classe Eloquent
        $typeInput = $request->reviewable_type;
        $reviewableClass = match ($typeInput) {
            'katana'                  => \App\Models\ProductKatanas::class,
            'martial', 'martial_arts' => \App\Models\MartialArts::class,
            'offer'                   => \App\Models\Offers::class,
            default                   => \App\Models\ProductKatanas::class
        };

        // 4. Verifica che l'utente non abbia già recensito questo prodotto
        $esistente = Review::where('user_id', $userId)
            ->where('reviewable_id', $request->reviewable_id)
            ->where('reviewable_type', $reviewableClass)
            ->first();

        if ($esistente) {
            return response()->json([
                'message' => 'Hai già lasciato una recensione per questo prodotto.'
            ], 422);
        }

        // 5. Creazione del record con i campi polimorfi corretti
        $review = Review::create([
            'user_id'         => $userId,
            'reviewable_id'   => $request->reviewable_id,
            'reviewable_type' => $reviewableClass,
            'rating'          => $request->rating,
            'comment'         => $request->comment,
        ]);

        return response()->json([
            'message' => 'Recensione aggiunta con successo!',
            'review'  => $review->load('user:id,name')
        ], 201);
    }

    /**
     * Recupera le ultime recensioni globali per la Home Page.
     */
    public function getLatestReviews()
    {
        $reviews = Review::with(['user:id,name', 'reviewable'])
            ->latest()
            ->take(6)
            ->get();

        return response()->json($reviews);
    }

    /**
     * Recupera le recensioni di un singolo prodotto filtrato per tipo.
     */
    public function getProductReviews(Request $request, $productId)
    {
        $type = $request->query('type', 'katana');

        $reviewableClass = match ($type) {
            'katana'                  => \App\Models\ProductKatanas::class,
            'martial', 'martial_arts' => \App\Models\MartialArts::class,
            'offer'                   => \App\Models\Offers::class,
            default                   => \App\Models\ProductKatanas::class
        };

        $reviews = Review::with('user:id,name')
            ->where('reviewable_id', $productId)
            ->where('reviewable_type', $reviewableClass)
            ->latest()
            ->get();

        return response()->json($reviews);
    }
}
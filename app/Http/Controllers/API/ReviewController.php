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
    // 1. Allineiamo la validazione accettando anche 'martial_arts' inviato dal JS
    $request->validate([
        'reviewable_id'   => 'required|integer',
        'reviewable_type' => 'required|string|in:katana,martial,martial_arts,offer',
        'rating'          => 'required|integer|min:1|max:5',
        'comment'         => 'nullable|string|max:1000',
    ]);

    // 2. Recuperiamo l'ID utente provando sia la sessione Web che le API
    $userId = Auth::id() ?? auth('web')->id();

    if (!$userId) {
        return response()->json(['message' => 'Utente non autenticato.'], 401);
    }

    // 3. Mappiamo il tipo stringa nel nome effettivo della classe Eloquent
    $typeInput = $request->reviewable_type;
    $reviewableClass = match($typeInput) {
        'katana'                 => \App\Models\ProductKatanas::class,
        'martial', 'martial_arts' => \App\Models\MartialArts::class,
        'offer'                  => \App\Models\Offers::class,
        default                  => \App\Models\ProductKatanas::class
    };

    // 4. Creazione del record con i campi polimorfi corretti
    $review = Review::create([
        'user_id'         => $userId, 
        'reviewable_id'   => $request->reviewable_id,
        'reviewable_type' => $reviewableClass, // Salva la classe intera (es. App\Models\ProductKatanas)
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
        $reviews = Review::with(['user:id,name', 'reviewable']) // Carica anche il prodotto associato
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
        // Recuperiamo il tipo dalla query string, es: /api/products/1/reviews?type=katana
        $type = $request->query('type', 'katana'); 

        $reviews = Review::with('user:id,name')
            ->where('reviewable_id', $productId)
            ->where('reviewable_type', $type)
            ->latest()
            ->get();

        return response()->json($reviews);
    }
}
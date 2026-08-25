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
        $request->validate([
            'reviewable_id'   => 'required|integer',
            'reviewable_type' => 'required|string|in:katana,martial,offer',
            'rating'          => 'required|integer|min:1|max:5',
            'comment'         => 'nullable|string|max:1000',
        ]);

        $userId = Auth::id();

        if (!$userId) {
            return response()->json(['message' => 'Utente non autenticato.'], 401);
        }

        // Grazie al morphMap registrato in AppServiceProvider, 'katana'/'martial'/'offer'
        // sono già gli alias corretti da salvare — non serve nessuna mappatura manuale qui.
        $esistente = Review::where('user_id', $userId)
            ->where('reviewable_id', $request->reviewable_id)
            ->where('reviewable_type', $request->reviewable_type)
            ->first();

        if ($esistente) {
            return response()->json([
                'message' => 'Hai già lasciato una recensione per questo prodotto.'
            ], 422);
        }

        $review = Review::create([
            'user_id'         => $userId,
            'reviewable_id'   => $request->reviewable_id,
            'reviewable_type' => $request->reviewable_type,
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

        $reviews = Review::with('user:id,name')
            ->where('reviewable_id', $productId)
            ->where('reviewable_type', $type)
            ->latest()
            ->get();

        return response()->json($reviews);
    }
}
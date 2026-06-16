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
            'product_id' => 'required|exists:product_katanas,id',
            'rating'     => 'required|integer|min:1|max:5',
            'comment'    => 'nullable|string|max:1000',
        ]);

        // Creiamo la recensione legandola all'utente autenticato tramite Sanctum/JWT
        $review = Review::create([
            'user_id'    => Auth::id(), // o $request->user()->id
            'product_id' => $request->product_id,
            'rating'     => $request->rating,
            'comment'    => $request->comment,
        ]);

        // Carichiamo la relazione dell'utente per restituire subito il nome nel front-end
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
        // Prendiamo le ultime 6 recensioni con i dati dell'utente associato
        $reviews = Review::with('user:id,name')
            ->latest()
            ->take(6)
            ->get();

        return response()->json($reviews);
    }

    /**
     * Recupera le recensioni di un singolo prodotto.
     */
    public function getProductReviews($productId)
    {
        $reviews = Review::with('user:id,name')
            ->where('product_id', $productId)
            ->latest()
            ->get();

        return response()->json($reviews);
    }
}

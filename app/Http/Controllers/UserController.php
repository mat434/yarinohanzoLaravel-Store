<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CustomKatana;
use App\Models\Order;

class UserController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $reviews = $user->reviews()->latest()->get();
        $customKatanas = CustomKatana::where('email', $user->email)->latest()->get();

        $orders = Order::with('items')->where('user_id', $user->id)->latest()->get();
        $activeOrders = $orders->where('status', 'in_lavorazione');
        $returnOrders = $orders->where('status', 'reso_richiesto');

        return view('user.profile', compact('user', 'reviews', 'customKatanas', 'activeOrders', 'returnOrders'));
    }

    public function requestReturn(Request $request, Order $order)
    {
        // Verifica che l'ordine appartenga davvero all'utente loggato (protezione IDOR)
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        if (!$order->canRequestReturn()) {
            return back()->with('message', 'Non è più possibile richiedere il reso per questo ordine.');
        }

        $request->validate([
            'reso_motivo' => 'required|string|max:1000',
        ]);

        $order->update([
            'status'            => 'reso_richiesto',
            'reso_motivo'       => $request->reso_motivo,
            'reso_richiesto_at' => now(),
        ]);

        return back()->with('success', 'Richiesta di reso inviata correttamente.');
    }
}
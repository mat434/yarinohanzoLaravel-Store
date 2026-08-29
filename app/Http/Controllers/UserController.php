<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\CustomKatana;
use App\Models\Order;
use App\Mail\ReturnRequestConfirmation;

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
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        if (!$order->canRequestReturn()) {
            return back()->with('message', 'Non è più possibile richiedere il reso per questo ordine.');
        }

        $validated = $request->validate([
            'return_method'            => 'required|in:domicilio,punto_postale',
            'motivo'                   => 'nullable|string|max:1000',
            'items'                    => 'required|array|min:1',
            'items.*.order_item_id'    => 'required|exists:order_items,id',
            'items.*.quantity'         => 'required|integer|min:1',
        ]);

        foreach ($validated['items'] as $item) {
            $orderItem = $order->items->firstWhere('id', $item['order_item_id']);

            if (!$orderItem) {
                abort(403, 'Articolo non appartenente a questo ordine.');
            }

            $giaResi = $orderItem->returnItems()
                ->whereHas('returnRequest', fn($q) => $q->where('status', '!=', 'rifiutato'))
                ->sum('quantity');

            $disponibile = $orderItem->quantity - $giaResi;

            if ($item['quantity'] > $disponibile) {
                return back()->withErrors([
                    'items' => "Hai già richiesto il reso per {$orderItem->nome}: puoi rendere al massimo {$disponibile} pezzi.",
                ]);
            }
        }

        $returnRequest = $order->returns()->create([
            'user_id'       => auth()->id(),
            'return_method' => $validated['return_method'],
            'motivo'        => $validated['motivo'] ?? null,
            'status'        => 'richiesto',
        ]);

        foreach ($validated['items'] as $item) {
            $returnRequest->items()->create([
                'order_item_id' => $item['order_item_id'],
                'quantity'      => $item['quantity'],
            ]);
        }

        $order->update([
            'status'            => 'reso_richiesto',
            'reso_motivo'       => $validated['motivo'] ?? null,
            'reso_richiesto_at' => now(),
        ]);

        Mail::to($order->email)->send(
    new ReturnRequestConfirmation($returnRequest, url('labels/etichetta-reso.pdf'))
);

        return back()->with('success', 'Richiesta di reso inviata correttamente.');
    }
}
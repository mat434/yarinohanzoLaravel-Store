<?php

namespace App\Http\Controllers;

use App\Models\ReturnRequest;
use Illuminate\Http\Request;

class AdminReturnController extends Controller
{
    public function index()
    {
        $returnRequests = ReturnRequest::with(['order', 'items.orderItem', 'user'])
            ->latest()
            ->get();

        return view('admin.returns.index', compact('returnRequests'));
    }

    public function updateStatus(Request $request, ReturnRequest $returnRequest)
    {
        $validated = $request->validate([
            'status' => 'required|in:richiesto,in_lavorazione,completato,rifiutato',
        ]);

        $returnRequest->update(['status' => $validated['status']]);

        return back()->with('success', 'Stato del reso aggiornato.');
    }
}
<?php

namespace App\Http\Controllers;

use App\Mail\CustomKatanaOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function personalizzakatana()
    {
        // 1. Carichiamo i dati dal config
        $options = config('katana');

        // 2. Passiamo i dati alla vista (fondamentale!)
        return view('personalizzakatana', compact('options'));
    }
    // Questa servirà dopo per ricevere i dati inviati dal form
    public function personalizzakatana_done(Request $request)
    {
        // Qui gestiremo l'invio (email, database, ecc.)
        $katanaMail = [
            'email' => $request->input('email'),
            'katana_name' => $request->input('katana_name'),
            'tsuka_length' => $request->input('tsuka_length'),
            'nagasa_length' => $request->input('nagasa_length'),
            'sori' => $request->input('sori'),
            'motohaba' => $request->input('motohaba'),
            'kitae' => $request->input('kitae'),
            'bohi' => $request->input('bohi'),
            'tsuba' => $request->input('tsuba'),
            'fuchikashira' => $request->input('fuchikashira'),
            'Menuki' => $request->input('Menuki'),
            'habaki' => $request->input('habaki'),
            'seppa' => $request->input('seppa'),
            'samegawa' => $request->input('samegawa'),
            'stile_tsuka' => $request->input('stile_tsuka'),
            'colore_tsuka' => $request->input('colore_tsuka'),
            'tipo_saya' => $request->input('tipo_saya'),
            'colore_sageo' => $request->input('colore_sageo')
            // Aggiungi qui altri campi se necessario
        ];

        // Invia la mail
        Mail::to('yarinohanzokatana@mail.com')->send(new CustomKatanaOrder($katanaMail));

        return redirect()->back()->with('success', 'La richiesta della tua katana è stata inviata con successo!');
    }
}

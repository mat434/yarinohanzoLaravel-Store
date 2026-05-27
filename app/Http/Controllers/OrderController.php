<?php

namespace App\Http\Controllers;

use App\Mail\CustomKatanaOrder;
use App\Models\CustomKatana;
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

    $customMessages = [
        'email.required'         => 'L\'indirizzo email è fondamentale per ricontattarti!',
        'email.email'            => 'Inserisci un indirizzo email valido, per favore.',
        'katana_name.required'   => 'Ogni spada ha bisogno di un nome. Come si chiamerà la tua?',
        'nagasa_lenght.required' => 'Devi specificare la lunghezza della lama (Nagasa).',
        'nagasa_lenght.min'      => 'La lama è troppo corta, il minimo è 30 cm.',
        'nagasa_lenght.max'      => 'Una lama superiore a 200 cm sarebbe impossibile da maneggiare!',
        'tsuka_lenght.required' => 'Indica la lunghezza dell\'impugnatura (Tsuka) per un equilibrio perfetto.',
        'tsuka_lenght.min'      => 'L\'impugnatura è troppo corta, il minimo è 15 cm.',
        'tsuka_lenght.max'      => 'Un\'impugnatura superiore a 60 cm sarebbe scomoda da usare!',
        'sori.required'         => 'Indica la curvatura (Sori) della lama per un design autentico.',
        'motohaba.required'     => 'Indica la larghezza alla base della lama (Motohaba) per un equilibrio ottimale.',
        'kitae.required'         => 'Seleziona il tipo di acciaio (Kitae) per la forgiatura.',
        'bohi.required'          => 'Indica se desideri un Bo-hi (canale decorativo) sulla lama.',
        'tsuba.required'         => 'Scegli uno stile di Tsuba (guardia) per la tua katana.',
        'fuchikashira.required'  => 'Scegli un design per Fuchi e Kashira (collare e pomello).',
        'menuki.required'        => 'Scegli un Menuki (decorazione sotto la tsuka) per personalizzare ulteriormente.',
        'habaki.required'        => 'Scegli un Habaki (collare della lama) per completare la tua katana.',
        'seppa.required'         => 'Indica se desideri Seppa (rondelle) per stabilizzare la lama nella saya.',
        'samegawa.required'      => 'Scegli il tipo di Samegawa (rivestimento in pelle di razza) per la tsuka.',
        'stile_tsuka.required'       => 'Scegli uno stile per la Tsuka (impugnatura) della tua katana.',
        'colore_tsuka.required'      => 'Scegli un colore per la Tsuka (impugnatura) della tua katana.',
        'tipo_saya.required'        => 'Scegli un tipo di Saya (fodero) per proteggere la tua lama.',
        'colore_sageo.required'     => 'Scegli un colore per il Sageo (cordino) della tua saya.',
        ];

        $validatedData = $request->validate([
            'email' => 'required|email',
            'katana_name' => 'required|string|max:255',
            'tsuka_lenght' => 'required|numeric|min:15|max:60',
            'nagasa_lenght' => 'required|numeric|min:30|max:200',
            'sori' => 'required|numeric',
            'motohaba' => 'required|numeric',
            'kitae' => 'required|string|',
            'bohi' => 'required|string|',
            'tsuba' => 'required|string|',
            'fuchikashira' => 'required|string|',
            'menuki' => 'required|string|',
            'habaki' => 'required|string|',
            'seppa' => 'required|string|',
            'samegawa' => 'required|string|',
            'stile_tsuka' => 'required|string|',
            'colore_tsuka' => 'required|string|',
            'tipo_saya' => 'required|string|',
            'colore_sageo' => 'required|string|',
        ],$customMessages);

        

        // 3. Recuperiamo i dati inviati dal form
        // $katanaMail = [
        //     'email' => $request->input('email'),
        //     'katana_name' => $request->input('katana_name'),
        //     'tsuka_length' => $request->input('tsuka_length'),
        //     'nagasa_length' => $request->input('nagasa_length'),
        //     'sori' => $request->input('sori'),
        //     'motohaba' => $request->input('motohaba'),
        //     'kitae' => $request->input('kitae'),
        //     'bohi' => $request->input('bohi'),
        //     'tsuba' => $request->input('tsuba'),
        //     'fuchikashira' => $request->input('fuchikashira'),
        //     'Menuki' => $request->input('Menuki'),
        //     'habaki' => $request->input('habaki'),
        //     'seppa' => $request->input('seppa'),
        //     'samegawa' => $request->input('samegawa'),
        //     'stile_tsuka' => $request->input('stile_tsuka'),
        //     'colore_tsuka' => $request->input('colore_tsuka'),
        //     'tipo_saya' => $request->input('tipo_saya'),
        //     'colore_sageo' => $request->input('colore_sageo')
        //     // Aggiungi qui altri campi se necessario
        // ];
        $validatedData['name'] = $validatedData['katana_name'];
        unset($validatedData['katana_name']); // Rimuoviamo la vecchia chiave non presente sul DB


        $customKatana = CustomKatana::create($validatedData);

        // Invia la mail
        Mail::to('yarinohanzokatana@mail.com')->send(new CustomKatanaOrder($customKatana));

        return redirect()->back()->with('success', 'La richiesta della tua katana è stata inviata con successo!');
    }
}

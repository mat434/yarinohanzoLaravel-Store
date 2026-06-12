<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function personalizzakatana()
    {
        // 1. Carichiamo i dati dal config
        $options = config('katana');

        // 2. Passiamo i dati alla vista
        return view('personalizzakatana', compact('options'));
    }

    public function personalizzakatana_done(Request $request)
    {
        $customMessages = [
            'email.required'         => 'L\'indirizzo email è fondamentale per ricontattarti!',
            'email.email'            => 'Inserisci un indirizzo email valido, per favore.',
            'katana_name.required'   => 'Ogni spada ha bisogno di un nome. Come si chiamerà la tua?',
            'nagasa_lenght.required' => 'Devi specificare la lunghezza della lama (Nagasa).',
            'nagasa_lenght.min'      => 'La lama è troppo corta, il minimo è 30 cm.',
            'nagasa_lenght.max'      => 'Una lama superiore a 200 cm sarebbe impossibile da maneggiare!',
            'tsuka_lenght.required'  => 'Indica la lunghezza dell\'impugnatura (Tsuka) per un equilibrio perfetto.',
            'tsuka_lenght.min'       => 'L\'impugnatura è troppo corta, il minimo è 15 cm.',
            'tsuka_lenght.max'       => 'Un\'impugnatura superiore a 60 cm sarebbe scomoda da usare!',
            'sori.required'          => 'Indica la curvatura (Sori) della lama per un design autentico.',
            'motohaba.required'      => 'Indica la larghezza alla base della lama (Motohaba) per un equilibrio ottimale.',
            'kitae.required'         => 'Seleziona il tipo di acciaio (Kitae) per la forgiatura.',
            'bohi.required'          => 'Indica se desideri un Bo-hi (canale decorativo) sulla lama.',
            'tsuba.required'         => 'Scegli uno stile di Tsuba (guardia) per la tua katana.',
            'fuchikashira.required'  => 'Scegli un design per Fuchi e Kashira (collare e pomello).',
            'menuki.required'        => 'Scegli un Menuki (decorazione sotto la tsuka) per personalizzare ulteriormente.',
            'habaki.required'        => 'Scegli un Habaki (collare della lama) per completare la tua katana.',
            'seppa.required'         => 'Indica se desideri Seppa (rondelle) per stabilizzare la lama nella saya.',
            'samegawa.required'      => 'Scegli il tipo di Samegawa (rivestimento in pelle di razza) per la tsuka.',
            'stile_tsuka.required'   => 'Scegli uno stile per la Tsuka (impugnatura) della tua katana.',
            'colore_tsuka.required'  => 'Scegli un colore per la Tsuka (impugnatura) della tua katana.',
            'tipo_saya.required'     => 'Scegli un tipo di Saya (fodero) per proteggere la tua lama.',
            'colore_sageo.required'  => 'Scegli un colore per il Sageo (cordino) della tua saya.',
        ];

        $validatedData = $request->validate([
            'email'         => 'required|email',
            'katana_name'   => 'required|string|max:255',
            'tsuka_lenght'  => 'required|numeric|min:15|max:60',
            'nagasa_lenght' => 'required|numeric|min:30|max:200',
            'sori'          => 'required|numeric',
            'motohaba'      => 'required|numeric',
            'kitae'         => 'required|string',
            'bohi'          => 'required|string',
            'tsuba'         => 'required|string',
            'fuchikashira'  => 'required|string',
            'menuki'        => 'required|string',
            'habaki'        => 'required|string',
            'seppa'         => 'required|string',
            'samegawa'      => 'required|string',
            'stile_tsuka'   => 'required|string',
            'colore_tsuka'  => 'required|string',
            'tipo_saya'     => 'required|string',
            'colore_sageo'  => 'required|string',
        ], $customMessages);

        // 1. Carichiamo il file config per tradurre gli ID in nomi leggibili
        $options = config('katana');

        // 2. Creiamo l'array con i nomi commerciali da mostrare a destra nel checkout
        $dettagliVisibili = [
            'Acciaio (Kitae)' => $this->getOptionName($options['acciaio'] ?? [], $validatedData['kitae']),
            'Sguscio (Bo-hi)' => $this->getOptionName($options['bohi'] ?? [], $validatedData['bohi']),
            'Tsuba'           => $this->getOptionName($options['tsuba'] ?? [], $validatedData['tsuba']),
            'Fuchi & Kashira' => $this->getOptionName($options['Fuchi_Kashira'] ?? [], $validatedData['fuchikashira']),
            'Menuki'          => $this->getOptionName($options['menuki'] ?? [], $validatedData['menuki']),
            'Habaki'          => $this->getOptionName($options['habaki'] ?? [], $validatedData['habaki']),
            'Seppa'           => $this->getOptionName($options['Seppa'] ?? [], $validatedData['seppa']),
            'Samegawa'        => $this->getOptionName($options['Samegawa'] ?? [], $validatedData['samegawa']),
            'Stile Tsuka'     => $this->getOptionName($options['Stile_Tsuka'] ?? [], $validatedData['stile_tsuka']),
            'Colore Tsuka'    => $this->getOptionName($options['Colore_Tsuka'] ?? [], $validatedData['colore_tsuka']),
            'Tipo Saya'       => $this->getOptionName($options['Tipo_Saya'] ?? [], $validatedData['tipo_saya']),
            'Colore Sageo'    => $this->getOptionName($options['Colore_Sageo'] ?? [], $validatedData['colore_sageo']),
        ];

        // 3. Prepariamo il pacchetto completo da salvare in sessione
        $summary = [
            'info'              => $validatedData, // Mantiene i dati nativi pronti per il DB
            'dettagli_visibili' => $dettagliVisibili,
            'prezzo'            => 450.00 // Puoi impostare il prezzo reale qui
        ];

        // 4. Mettiamo in sessione e puliamo il carrello standard
        session(['custom_katana' => $summary]);
        session()->forget('cart');

        // 5. Reindirizziamo alla rotta del checkout
        return redirect()->to('/checkout');
    }

    private function getOptionName($subOptions, $id)
    {
        foreach ($subOptions as $item) {
            if (isset($item['id']) && $item['id'] == $id) {
                return $item['name'];
            }
        }
        return $id;
    }
}
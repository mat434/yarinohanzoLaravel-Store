<?php

namespace Database\Seeders;

use App\Models\Offers;
use App\Models\Subcategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductOffersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $subKaizen       = Subcategory::where('slug', 'katana-kaizen')->first();
        $subAnniversario = Subcategory::where('slug', 'katana-18anniversario-yarinohanzo')->first();
        $subBudospring   = Subcategory::where('slug', 'budospring-2026')->first();
        $subOccasioni    = Subcategory::where('slug', 'angolo-delle-occasioni')->first();

        // Nuove categorie richieste
        $subOni          = Subcategory::where('slug', 'oni-by-yarinohanzo')->first();
        $subHandmade     = Subcategory::where('slug', 'yarinohanzo-handmade')->first();
        $subShogun       = Subcategory::where('slug', 'katana-shogun-elite')->first();


        // 2. INSERIMENTO DEI DATI DI ESEMPIO NELLE OFFERTE

        // Katana Kaizen
        Offers::create([
            'nome' => 'Motonari Iaito Kaizen', 
                'prezzo' => 5400, 
                'acciaio' => '1060 High Carbon', 
                'larghezzalama' => 2, 
                'lunghezzalama' => 100, 
                'lunghezzatsuka' => 50, 
                'descrizione' => 'Una katana Iaito leggendaria appartenente della famiglia Motonari.', 
                'img' => 'imgoffer/MOTONARIIAITOKAIZEN.jpg', // Cambiato 'img' in 'immagine' se sul DB si chiama così
                'subcategory_id' => $subKaizen->id 
        ]);

        // 18 anniversario
        Offers::create([
            'martial_art_id'  => null,
            'katana_id'       => 4,
            'subcategory_id'  => $subKaizen ? $subKaizen->id : null,
            'prezzo_scontato' => 250
        ]);

        // [Katana 18° Anniversario] - Katana Speciale (ID 5)
        Offers::create([
            'nome' => 'Katana 18° Anniversario', 
                'prezzo' => 12000, 
                'acciaio' => '1060 High Carbon', 
                'larghezzalama' => 2, 
                'lunghezzalama' => 100, 
                'lunghezzatsuka' => 50, 
                'descrizione' => 'Una katana Ispirata al FujiSan per celebrare il 18° anniversario di YariNoHanzo.', 
                'img' => 'imgoffer/FUJIKATANA18.jpg', // Cambiato 'img' in 'immagine' se sul DB si chiama così
                'subcategory_id' => $subAnniversario?->id,
        ]);

        // [Angolo delle Occasioni] - Articolo Marziale (ID 2)
        Offers::create([
            'martial_art_id'  => 2,
            'katana_id'       => null,
            'subcategory_id'  => $subOccasioni ? $subOccasioni->id : null,
            'prezzo_scontato' => 45
        ]);

        // [ONI by YariNoHanzo] - Katana Linea Oni (ID 6)
        Offers::create([
            'nome' => 'Maglia ONI by YariNoHanzo', 
                'prezzo' => 22, 
                'materiale' => 'Cotone biologioco',
                'descrizione' => 'Maglia in collaborazione con By ONI ', 
                'img' => 'imgoffer/0MAGLIAONIBY.jpg', // Cambiato 'img' in 'immagine' se sul DB si chiama così
                'subcategory_id' => $subOni->id 
        ]);

        // [YariNoHanzo Handmade] - Katana Artigianale (ID 7)
        Offers::create([
            'nome' => 'Kamei Katana Superior', 
                'prezzo' => 1500, 
                'materiale' => '',
                'descrizione' => 'Una katana leggendaria appartenente alla famiglia Hattori.', 
                'img' => 'imgoffer/0HANDMADESACCANINJA.jpg', // Cambiato 'img' in 'immagine' se sul DB si chiama così
                'subcategory_id' => $subHandmade->id 
        ]);

        // [Katana Shogun Elite] - Katana Top di Gamma (ID 8)
        Offers::create([
            'nome' => 'Shogun Elite Pro', 
                'prezzo' => 3000, 
                'acciaio' => '1060 High Carbon', 
                'larghezzalama' => 2, 
                'lunghezzalama' => 100, 
                'lunghezzatsuka' => 50, 
                'descrizione' => 'FUjiKatana ShogunElite è una katana di altissima qualità, realizzata con materiali pregiati e una maestria artigianale eccezionale. La lama è forgiata in acciaio 1060 High Carbon, garantendo una resistenza superiore e un filo affilato come un rasoio. Il design elegante e raffinato si ispira alla tradizione giapponese, con dettagli curati e finiture di alta qualità. Questa katana è perfetta per collezionisti esigenti e appassionati di arti marziali che cercano un pezzo unico e prestigioso.', 
                'img' => 'imgoffer/1FUJIKATANA18.jpg', // Cambiato 'img' in 'immagine' se sul DB si chiama così
                'subcategory_id' => $subShogun->id // 
        ]);



        \App\Models\Offers::create([
            'martial_art_id' => 1,
            'prezzo_scontato' => 80
        ]);

        // Esempio: Mettere in offerta la Katana del Drago (ID 4 in product_katanas)
        \App\Models\Offers::create([
            'katana_id' => 4,
            'prezzo_scontato' => 250
        ]);
    }
}

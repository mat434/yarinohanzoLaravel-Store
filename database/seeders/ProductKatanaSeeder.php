<?php

namespace Database\Seeders;

use App\Models\ProductKatanas;
use App\Models\Subcategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductKatanaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // 1. Recuperiamo le sottocategorie reali presenti nel DB (create dal SubcategorySeeder)
        // Usiamo gli slug precisi che abbiamo inserito nell'altro seeder!
        $subBasics      = Subcategory::where('slug', 'basics')->first();
        $subPractical   = Subcategory::where('slug', 'practical')->first();
        $subSuperior    = Subcategory::where('slug', 'superior')->first();
        $subTanto       = Subcategory::where('slug', 'tanto')->first();
        $subWakizashi   = Subcategory::where('slug', 'wakizashi')->first();
        $subManutenzione = Subcategory::where('slug', 'kit-manutenzione')->first();
        $subSpecial     = Subcategory::where('slug', 'alternative-special')->first();
        $subDaisho       = Subcategory::where('slug', 'daisho-set-katana')->first();
        $subPerfomance   = Subcategory::where('slug', 'performance')->first();
        $subDamasco     = Subcategory::where('slug', 'damasco')->first();

        // 2. Prepariamo l'array. Ho aggiunto ad ognuno la chiave 'subcategory_id' collegata ai modelli sopra!
        $katanaaccessori = [
            [
                'nome' => 'Kamei Katana Superior', 
                'prezzo' => 1500, 
                'acciaio' => '1060 High Carbon', 
                'larghezzalama' => 2, 
                'lunghezzalama' => 100, 
                'lunghezzatsuka' => 50, 
                'descrizione' => 'Una katana leggendaria appartenente alla famiglia Hattori.', 
                'img' => 'imgkatana/0kameikatanaSUPERIOR.jpg', // Cambiato 'img' in 'immagine' se sul DB si chiama così
                'subcategory_id' => $subSuperior->id // <-- Legata a Superior
            ],
            [
                'nome' => 'Tombo Superior', 
                'prezzo' => 1200, 
                'acciaio' => '1060 High Carbon', 
                'larghezzalama' => 2, 
                'lunghezzalama' => 100, 
                'lunghezzatsuka' => 50,
                'descrizione' => 'Una katana leggendaria appartenente alla famiglia Muramasa.', 
                'img' => 'imgkatana/0TOMBOSUPERIOR.jpg',
                'subcategory_id' => $subSuperior->id // <-- Legata a Superior
            ],
            [
                'nome' => 'Ikedaka Katana Practical', 
                'prezzo' => 50, 
                'acciaio' => '1090 High Carbon', 
                'larghezzalama' => 2, 
                'lunghezzalama' => 100, 
                'lunghezzatsuka' => 50, 
                'descrizione' => 'Un bokken utilizzato per l\'allenamento.', 
                'img' => 'imgkatana/ikedakatanaPRACTICAL.jpg',
                'subcategory_id' => $subPractical->id // <-- Legata a Practical
            ],
            [
                'nome' => 'Kocho Katana Basics', 
                'prezzo' => 300, 
                'acciaio' => '1060 High Carbon', 
                'larghezzalama' => 2, 
                'lunghezzalama' => 100, 
                'lunghezzatsuka' => 50,  
                'descrizione' => 'Una katana decorativa ispirata al drago.', 
                'img' => 'imgkatana/kochokatanaBASICS.jpg',
                'subcategory_id' => $subBasics->id // <-- Legata a Basics
            ],
            [
                'nome' => 'Yamamoto Katana Practical', 
                'prezzo' => 800, 
                'acciaio' => '1045 High Carbon', 
                'larghezzalama' => 2, 
                'lunghezzalama' => 100, 
                'lunghezzatsuka' => 50, 
                'descrizione' => 'Una lama leggendaria appartenente alla famiglia Shisui.', 
                'img' => 'imgkatana/YAMAMOTOKATANAPRACTICAL.jpg',
                'subcategory_id' => $subPractical->id // <-- Legata a Practical
            ],
            [
                'nome' => 'Wakizashi Minamoto', 
                'prezzo' => 150, 
                'acciaio' => '1060 High Carbon', 
                'larghezzalama' => 2, 
                'lunghezzalama' => 100, 
                'lunghezzatsuka' => 50, 
                'descrizione' => 'Un wakizashi utilizzato per l\'allenamento.', 
                'img' => 'imgkatana/MINAMOTOTANTO.jpg',
                'subcategory_id' => $subWakizashi->id // <-- Legata a Wakizashi
            ],
            [
                'nome' => 'Tanto YariNoHanzo', 
                'prezzo' => 450, 
                'acciaio' => '1045 High Carbon', 
                'larghezzalama' => 2, 
                'lunghezzalama' => 100, 
                'lunghezzatsuka' => 50,  
                'descrizione' => 'Un tanto di giada utilizzato per l\'ornamento.', 
                'img' => 'imgkatana/MINAMOTOTANTO.jpg',
                'subcategory_id' => $subTanto->id // <-- Legata a Tanto
            ],
            [
                'nome' => 'Nodachi Shiruya Special', 
                'prezzo' => 600, 
                'acciaio' => '1045 High Carbon', 
                'larghezzalama' => 2, 
                'lunghezzalama' => 100, 
                'lunghezzatsuka' => 50, 
                'descrizione' => 'Una katana realizzata in carbonio.', 
                'img' => 'imgkatana/0NODACHISPECIAL.jpg',
                'subcategory_id' => $subSpecial->id // <-- Legata a Special
            ],
            [
                'nome' => 'Shinobi Katana Perfomance', 
                'prezzo' => 2500, 
                'acciaio' => '1095 High Carbon', 
                'larghezzalama' => 2, 
                'lunghezzalama' => 100, 
                'lunghezzatsuka' => 50, 
                'descrizione' => 'Una lama imperiale appartenente alla famiglia imperiale.', 
                'img' => 'imgkatana/SHINOBIKATANAPERFOMANCE.jpg',
                'subcategory_id' => $subPerfomance->id // <-- Legata a Superior
            ],
            [
                'nome' => 'Katana ASAKURA DAISHO', 
                'prezzo' => 350, 
                'acciaio' => '1095 High Carbon', 
                'larghezzalama' => 2, 
                'lunghezzalama' => 100, 
                'lunghezzatsuka' => 50,  
                'descrizione' => 'Una katana decorativa ispirata al ciliegio.', 
                'img' => 'imgkatana/ASAKURADAISHO2.jpg',
                'subcategory_id' => $subDaisho->id // <-- Legata a Daisho
            ],
            [
                'nome' => 'Kit di Pulizia Tradizionale', 
                'prezzo' => 35, 
                'acciaio' => 'Nessuno', // Gli accessori non hanno acciaio, mettiamo un valore finto o nullo se la colonna lo permette
                'larghezzalama' => 0, 
                'lunghezzalama' => 0, 
                'lunghezzatsuka' => 0,  
                'descrizione' => 'Kit completo di polvere di pietra (uchiko), olio di garofano e martelletto.', 
                'img' => 'imgkatana/MANUTENZIONE/MANUTENZIONEKIT.jpg',
                'subcategory_id' => $subManutenzione->id // <-- Legata a Kit Manutenzione!
            ],
        ];

        // 3. Ciclo per salvare tutto nel database
        foreach ($katanaaccessori as $prodotto) {
            ProductKatanas::create($prodotto);
        }
    }
}

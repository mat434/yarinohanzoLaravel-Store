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
        $subSpecial     = Subcategory::where('slug', 'special')->first();
        $subDaisho       = Subcategory::where('slug', 'daisho')->first();
        $subPerfomance   = Subcategory::where('slug', 'performance')->first();
        $subDamasco     = Subcategory::where('slug', 'damasco')->first();

        // 2. Prepariamo l'array. Ho aggiunto ad ognuno la chiave 'subcategory_id' collegata ai modelli sopra!
        $katanaaccessori = [
            [
                'nome' => 'Hattori Hanzo', 
                'prezzo' => 1500, 
                'acciaio' => 'High Carbon', 
                'larghezzalama' => 2, 
                'lunghezzalama' => 100, 
                'lunghezzatsuka' => 50, 
                'descrizione' => 'Una katana leggendaria appartenente alla famiglia Hattori.', 
                'img' => 'imgkatana/0kameikatanaSUPERIOR.jpg', // Cambiato 'img' in 'immagine' se sul DB si chiama così
                'subcategory_id' => $subSuperior->id // <-- Legata a Superior
            ],
            [
                'nome' => 'Muramasa', 
                'prezzo' => 1200, 
                'acciaio' => 'High Carbon', 
                'larghezzalama' => 2, 
                'lunghezzalama' => 100, 
                'lunghezzatsuka' => 50,
                'descrizione' => 'Una katana leggendaria appartenente alla famiglia Muramasa.', 
                'img' => 'imgkatana/0TOMBOSUPERIOR',
                'subcategory_id' => $subSuperior->id // <-- Legata a Superior
            ],
            [
                'nome' => 'Bokken Allenamento', 
                'prezzo' => 50, 
                'acciaio' => 'High Carbon', 
                'larghezzalama' => 2, 
                'lunghezzalama' => 100, 
                'lunghezzatsuka' => 50, 
                'descrizione' => 'Un bokken utilizzato per l\'allenamento.', 
                'img' => 'imgkatana/ikedakatanaPRACTICAL.jpg',
                'subcategory_id' => $subPractical->id // <-- Legata a Practical
            ],
            [
                'nome' => 'Katana del Drago', 
                'prezzo' => 300, 
                'acciaio' => 'High Carbon', 
                'larghezzalama' => 2, 
                'lunghezzalama' => 100, 
                'lunghezzatsuka' => 50,  
                'descrizione' => 'Una katana decorativa ispirata al drago.', 
                'img' => 'imgkatana/kochokatanaBASICS.jpg',
                'subcategory_id' => $subBasics->id // <-- Legata a Basics
            ],
            [
                'nome' => 'Lama di Shisui', 
                'prezzo' => 800, 
                'acciaio' => 'High Carbon', 
                'larghezzalama' => 2, 
                'lunghezzalama' => 100, 
                'lunghezzatsuka' => 50, 
                'descrizione' => 'Una lama leggendaria appartenente alla famiglia Shisui.', 
                'img' => 'imgkatana/YAMAMOTOKATANAPRACTICAL.jpg',
                'subcategory_id' => $subPractical->id // <-- Legata a Practical
            ],
            [
                'nome' => 'Wakizashi Base', 
                'prezzo' => 150, 
                'acciaio' => 'High Carbon', 
                'larghezzalama' => 2, 
                'lunghezzalama' => 100, 
                'lunghezzatsuka' => 50, 
                'descrizione' => 'Un wakizashi utilizzato per l\'allenamento.', 
                'img' => 'imgkatana/MINAMOTOTANTO.jpg',
                'subcategory_id' => $subWakizashi->id // <-- Legata a Wakizashi
            ],
            [
                'nome' => 'Tanto di Giada', 
                'prezzo' => 450, 
                'acciaio' => 'High Carbon', 
                'larghezzalama' => 2, 
                'lunghezzalama' => 100, 
                'lunghezzatsuka' => 50,  
                'descrizione' => 'Un tanto di giada utilizzato per l\'ornamento.', 
                'img' => 'imgkatana/MINAMOTOTANTO.jpg',
                'subcategory_id' => $subTanto->id // <-- Legata a Tanto
            ],
            [
                'nome' => 'Katana in Carbonio', 
                'prezzo' => 600, 
                'acciaio' => 'High Carbon', 
                'larghezzalama' => 2, 
                'lunghezzalama' => 100, 
                'lunghezzatsuka' => 50, 
                'descrizione' => 'Una katana realizzata in carbonio.', 
                'img' => 'imgkatana/0NODACHISPECIAL.jpg',
                'subcategory_id' => $subSpecial->id // <-- Legata a Special
            ],
            [
                'nome' => 'Lama Imperiale', 
                'prezzo' => 2500, 
                'acciaio' => 'High Carbon', 
                'larghezzalama' => 2, 
                'lunghezzalama' => 100, 
                'lunghezzatsuka' => 50, 
                'descrizione' => 'Una lama imperiale appartenente alla famiglia imperiale.', 
                'img' => 'immagini/muraka.jpg',
                'subcategory_id' => $subSuperior->id // <-- Legata a Superior
            ],
            [
                'nome' => 'Katana Sakura', 
                'prezzo' => 350, 
                'acciaio' => 'High Carbon', 
                'larghezzalama' => 2, 
                'lunghezzalama' => 100, 
                'lunghezzatsuka' => 50,  
                'descrizione' => 'Una katana decorativa ispirata al ciliegio.', 
                'img' => 'immagini/muraka.jpg',
                'subcategory_id' => $subBasics->id // <-- Legata a Basics
            ],
            [
                'nome' => 'Kit di Pulizia Tradizionale', 
                'prezzo' => 35, 
                'acciaio' => 'Nessuno', // Gli accessori non hanno acciaio, mettiamo un valore finto o nullo se la colonna lo permette
                'larghezzalama' => 0, 
                'lunghezzalama' => 0, 
                'lunghezzatsuka' => 0,  
                'descrizione' => 'Kit completo di polvere di pietra (uchiko), olio di garofano e martelletto.', 
                'img' => 'immagini/kit.jpg',
                'subcategory_id' => $subManutenzione->id // <-- Legata a Kit Manutenzione!
            ],
        ];

        // 3. Ciclo per salvare tutto nel database
        foreach ($katanaaccessori as $prodotto) {
            ProductKatanas::create($prodotto);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductArtialMartsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $artimarziali = [
            ['nome' => 'Gi', 'prezzo' => 50, 'materiale' => 'cotone' , 'descrizione' => 'Un gi utilizzato per l\'allenamento.' , 'img' => 'immagini/nobunaga.jpg'],
            ['nome' => 'Hakama', 'prezzo' => 100, 'materiale' => 'cotone 100%' , 'descrizione' => 'Un hakama utilizzato per l\'allenamento.' , 'img' => 'immagini/fukushima.jpg'],
            ['nome' => 'Bokken Allenamento', 'prezzo' => 50, 'materiale' => 'legno di faggio' , 'descrizione' => 'Un bokken utilizzato per l\'allenamento.' , 'img' => 'immagini/muraka.jpg'],
            ['nome' => 'Katana del Drago', 'prezzo' => 300, 'materiale' => 'acciaio 1095', 'descrizione' => 'Una katana decorativa ispirata al drago.' , 'img' => 'immagini/yagyu.jpg'],
            ['nome' => 'Lama di Shisui', 'prezzo' => 800, 'materiale' => 'legno di faggio colorato', 'descrizione' => 'Una lama leggendaria appartenente alla famiglia Shisui.' , 'img' => 'immagini/fukushima.jpg'],
            ['nome' => 'Wakizashi Base', 'prezzo' => 150, 'materiale' => 'acciaio', 'descrizione' => 'Un wakizashi utilizzato per l\'allenamento.' , 'img' => 'immagini/fukushima.jpg'],
            ['nome' => 'Tanto di Giada', 'prezzo' => 450, 'materiale' => 'Giada', 'descrizione' => 'Un tanto di giada utilizzato per l\'ornamento.' , 'img' => 'immagini/nobunaga.jpg'],
            ['nome' => 'Katana in Carbonio', 'prezzo' => 600, 'materiale' => 'cabonio risoluto', 'descrizione' => 'Una katana realizzata in carbonio.' , 'img' => 'immagini/yagyu.jpg'],
            ['nome' => 'Lama Imperiale', 'prezzo' => 2500, 'materiale' => 'acciaio argilla', 'descrizione' => 'Una lama imperiale appartenente alla famiglia imperiale.' , 'img' => 'immagini/muraka.jpg'],
            ['nome' => 'Katana Sakura', 'prezzo' => 350, 'materiale' => 'acciaio argilla', 'descrizione' => 'Una katana decorativa ispirata al ciliegio.' , 'img' => 'immagini/muraka.jpg'],
        ];

        foreach ($artimarziali as $prodotto) {
            \App\Models\MartialArts::create($prodotto);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductKatanaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $katanaaccessori = [
            ['nome' => 'Hattori Hanzo', 'prezzo' => 1500, 'acciaio' => 'High Carbon', 'larghezzalama' =>2, 'lunghezzalama' => 100, 'lunghezzatsuka' => 50, 'categoria' => 'Storiche', 'descrizione' => 'Una katana leggendaria appartenente alla famiglia Hattori.' , 'img' => 'immagini/fukushima.jpg'],
            ['nome' => 'Muramasa', 'prezzo' => 1200, 'acciaio' => 'High Carbon', 'larghezzalama' =>2, 'lunghezzalama' => 100, 'lunghezzatsuka' => 50, 'categoria' => 'Leggendarie', 'descrizione' => 'Una katana leggendaria appartenente alla famiglia Muramasa.' , 'img' => 'immagini/nobunaga.jpg'],
            ['nome' => 'Bokken Allenamento', 'prezzo' => 50, 'acciaio' => 'High Carbon', 'larghezzalama' =>2, 'lunghezzalama' => 100, 'lunghezzatsuka' => 50, 'categoria' => 'Pratica', 'descrizione' => 'Un bokken utilizzato per l\'allenamento.' , 'img' => 'immagini/muraka.jpg'],
            ['nome' => 'Katana del Drago', 'prezzo' => 300, 'acciaio' => 'High Carbon', 'larghezzalama' =>2, 'lunghezzalama' => 100, 'lunghezzatsuka' => 50, 'categoria' => 'Ornamentali', 'descrizione' => 'Una katana decorativa ispirata al drago.' , 'img' => 'immagini/yagyu.jpg'],
            ['nome' => 'Lama di Shisui', 'prezzo' => 800, 'acciaio' => 'High Carbon', 'larghezzalama' =>2, 'lunghezzalama' => 100, 'lunghezzatsuka' => 50, 'categoria' => 'Leggendarie', 'descrizione' => 'Una lama leggendaria appartenente alla famiglia Shisui.' , 'img' => 'immagini/fukushima.jpg'],
            ['nome' => 'Wakizashi Base', 'prezzo' => 150, 'acciaio' => 'High Carbon', 'larghezzalama' =>2, 'lunghezzalama' => 100, 'lunghezzatsuka' => 50, 'categoria' => 'Pratica', 'descrizione' => 'Un wakizashi utilizzato per l\'allenamento.' , 'img' => 'immagini/fukushima.jpg'],
            ['nome' => 'Tanto di Giada', 'prezzo' => 450, 'acciaio' => 'High Carbon', 'larghezzalama' =>2, 'lunghezzalama' => 100, 'lunghezzatsuka' => 50, 'categoria' => 'Ornamentali', 'descrizione' => 'Un tanto di giada utilizzato per l\'ornamento.' , 'img' => 'immagini/nobunaga.jpg'],
            ['nome' => 'Katana in Carbonio', 'prezzo' => 600, 'acciaio' => 'High Carbon', 'larghezzalama' =>2, 'lunghezzalama' => 100, 'lunghezzatsuka' => 50, 'categoria' => 'Pratica', 'descrizione' => 'Una katana realizzata in carbonio.' , 'img' => 'immagini/yagyu.jpg'],
            ['nome' => 'Lama Imperiale', 'prezzo' => 2500, 'acciaio' => 'High Carbon', 'larghezzalama' =>2, 'lunghezzalama' => 100, 'lunghezzatsuka' => 50, 'categoria' => 'Leggendarie', 'descrizione' => 'Una lama imperiale appartenente alla famiglia imperiale.' , 'img' => 'immagini/muraka.jpg'],
            [ 'nome' => 'Katana Sakura', 'prezzo' => 350, 'acciaio' => 'High Carbon', 'larghezzalama' =>2, 'lunghezzalama' => 100, 'lunghezzatsuka' => 50, 'categoria' => 'Ornamentali', 'descrizione' => 'Una katana decorativa ispirata al ciliegio.' , 'img' => 'immagini/muraka.jpg'],
        ];

        foreach ($katanaaccessori as $prodotto) {
            \App\Models\ProductKatanas::create($prodotto);
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function welcome()
    {
        return view('welcome');
    }

    public function article()
    {
        return view('article');
    }

    public function offers()
    {
        $katana = [
            ['id' => 1, 'nome' => 'Hattori Hanzo', 'prezzo' => 1500, 'acciaio' => 'High Carbon', 'lunghezzalama' => 100, 'lunghezzatsuka' => 50, 'categoria' => 'Storiche', 'descrizione' => 'Una katana leggendaria appartenente alla famiglia Hattori.' , 'img' => 'immagini/fukushima.jpg'],
            ['id' => 2, 'nome' => 'Muramasa', 'prezzo' => 1200, 'acciaio' => 'High Carbon', 'lunghezzalama' => 100, 'lunghezzatsuka' => 50, 'categoria' => 'Leggendarie', 'descrizione' => 'Una katana leggendaria appartenente alla famiglia Muramasa.' , 'img' => 'immagini/nobunaga.jpg'],
            ['id' => 3, 'nome' => 'Bokken Allenamento', 'prezzo' => 50, 'acciaio' => 'High Carbon', 'lunghezzalama' => 100, 'lunghezzatsuka' => 50, 'categoria' => 'Pratica', 'descrizione' => 'Un bokken utilizzato per l\'allenamento.' , 'img' => 'immagini/muraka.jpg'],
            ['id' => 4, 'nome' => 'Katana del Drago', 'prezzo' => 300, 'acciaio' => 'High Carbon', 'lunghezzalama' => 100, 'lunghezzatsuka' => 50, 'categoria' => 'Ornamentali', 'descrizione' => 'Una katana decorativa ispirata al drago.' , 'img' => 'immagini/yagyu.jpg'],
            ['id' => 5, 'nome' => 'Lama di Shisui', 'prezzo' => 800, 'acciaio' => 'High Carbon', 'lunghezzalama' => 100, 'lunghezzatsuka' => 50, 'categoria' => 'Storiche', 'descrizione' => 'Una lama leggendaria appartenente alla famiglia Shisui.' , 'img' => 'immagini/fukushima.jpg'],
            ['id' => 6, 'nome' => 'Wakizashi Base', 'prezzo' => 150, 'acciaio' => 'High Carbon', 'lunghezzalama' => 100, 'lunghezzatsuka' => 50, 'categoria' => 'Pratica', 'descrizione' => 'Un wakizashi utilizzato per l\'allenamento.' , 'img' => 'immagini/fukushima.jpg'],
            ['id' => 7, 'nome' => 'Tanto di Giada', 'prezzo' => 450, 'acciaio' => 'High Carbon', 'lunghezzalama' => 100, 'lunghezzatsuka' => 50, 'categoria' => 'Ornamentali', 'descrizione' => 'Un tanto di giada utilizzato per l\'ornamento.' , 'img' => 'immagini/nobunaga.jpg'],
            ['id' => 8, 'nome' => 'Katana in Carbonio', 'prezzo' => 600, 'acciaio' => 'High Carbon', 'lunghezzalama' => 100, 'lunghezzatsuka' => 50, 'categoria' => 'Pratica', 'descrizione' => 'Una katana realizzata in carbonio.' , 'img' => 'immagini/yagyu.jpg'],
            ['id' => 9, 'nome' => 'Lama Imperiale', 'prezzo' => 2500, 'acciaio' => 'High Carbon', 'lunghezzalama' => 100, 'lunghezzatsuka' => 50, 'categoria' => 'Leggendarie', 'descrizione' => 'Una lama imperiale appartenente alla famiglia imperiale.' , 'img' => 'immagini/muraka.jpg'],
            ['id' => 10, 'nome' => 'Katana Sakura', 'prezzo' => 350, 'acciaio' => 'High Carbon', 'lunghezzalama' => 100, 'lunghezzatsuka' => 50, 'categoria' => 'Ornamentali', 'descrizione' => 'Una katana decorativa ispirata al ciliegio.' , 'img' => 'immagini/muraka.jpg'],
        ];
        return view('offers', ['offerte' => $katana]);
    }

    public function login()
    {
        return view('login');
    }
}

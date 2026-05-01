<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicController extends Controller
{

private $katanaaccessori = [
            ['id' => 1, 'nome' => 'Hattori Hanzo', 'prezzo' => 1500, 'acciao' => 'High Carbon', 'lunghezzalama' => 100, 'lunghezzatsuka' => 50, 'categoria' => 'Storiche', 'descrizione' => 'Una katana leggendaria appartenente alla famiglia Hattori.' , 'img' => 'immagini/fukushima.jpg'],
            ['id' => 2, 'nome' => 'Muramasa', 'prezzo' => 1200, 'acciao' => 'High Carbon', 'lunghezzalama' => 100, 'lunghezzatsuka' => 50, 'categoria' => 'Leggendarie', 'descrizione' => 'Una katana leggendaria appartenente alla famiglia Muramasa.' , 'img' => 'immagini/nobunaga.jpg'],
            ['id' => 3, 'nome' => 'Bokken Allenamento', 'prezzo' => 50, 'acciao' => 'High Carbon', 'lunghezzalama' => 100, 'lunghezzatsuka' => 50, 'categoria' => 'Pratica', 'descrizione' => 'Un bokken utilizzato per l\'allenamento.' , 'img' => 'immagini/muraka.jpg'],
            ['id' => 4, 'nome' => 'Katana del Drago', 'prezzo' => 300, 'acciao' => 'High Carbon', 'lunghezzalama' => 100, 'lunghezzatsuka' => 50, 'categoria' => 'Ornamentali', 'descrizione' => 'Una katana decorativa ispirata al drago.' , 'img' => 'immagini/yagyu.jpg'],
            ['id' => 5, 'nome' => 'Lama di Shisui', 'prezzo' => 800, 'acciao' => 'High Carbon', 'lunghezzalama' => 100, 'lunghezzatsuka' => 50, 'categoria' => 'Leggendarie', 'descrizione' => 'Una lama leggendaria appartenente alla famiglia Shisui.' , 'img' => 'immagini/fukushima.jpg'],
            ['id' => 6, 'nome' => 'Wakizashi Base', 'prezzo' => 150, 'acciao' => 'High Carbon', 'lunghezzalama' => 100, 'lunghezzatsuka' => 50, 'categoria' => 'Pratica', 'descrizione' => 'Un wakizashi utilizzato per l\'allenamento.' , 'img' => 'immagini/fukushima.jpg'],
            ['id' => 7, 'nome' => 'Tanto di Giada', 'prezzo' => 450, 'acciao' => 'High Carbon', 'lunghezzalama' => 100, 'lunghezzatsuka' => 50, 'categoria' => 'Ornamentali', 'descrizione' => 'Un tanto di giada utilizzato per l\'ornamento.' , 'img' => 'immagini/nobunaga.jpg'],
            ['id' => 8, 'nome' => 'Katana in Carbonio', 'prezzo' => 600, 'acciao' => 'High Carbon', 'lunghezzalama' => 100, 'lunghezzatsuka' => 50, 'categoria' => 'Pratica', 'descrizione' => 'Una katana realizzata in carbonio.' , 'img' => 'immagini/yagyu.jpg'],
            ['id' => 9, 'nome' => 'Lama Imperiale', 'prezzo' => 2500, 'acciao' => 'High Carbon', 'lunghezzalama' => 100, 'lunghezzatsuka' => 50, 'categoria' => 'Leggendarie', 'descrizione' => 'Una lama imperiale appartenente alla famiglia imperiale.' , 'img' => 'immagini/muraka.jpg'],
            ['id' => 10, 'nome' => 'Katana Sakura', 'prezzo' => 350, 'acciao' => 'High Carbon', 'lunghezzalama' => 100, 'lunghezzatsuka' => 50, 'categoria' => 'Ornamentali', 'descrizione' => 'Una katana decorativa ispirata al ciliegio.' , 'img' => 'immagini/muraka.jpg'],
        ];

private $artimarziali = [
            ['id' => 1, 'nome' => 'Hakama', 'prezzo' => 100, 'caratteristica1 => cotone 100%' , 'descrizione' => 'Un hakama utilizzato per l\'allenamento.' , 'img' => 'immagini/fukushima.jpg'],
            ['id' => 2, 'nome' => 'Gi', 'prezzo' => 50, 'caratteristica1 => unisex' , 'descrizione' => 'Un gi utilizzato per l\'allenamento.' , 'img' => 'immagini/nobunaga.jpg'],
            ['id' => 3, 'nome' => 'Bokken Allenamento', 'prezzo' => 50, 'caratteristica1 => legno di faggio' , 'descrizione' => 'Un bokken utilizzato per l\'allenamento.' , 'img' => 'immagini/muraka.jpg'],
            ['id' => 4, 'nome' => 'Katana del Drago', 'prezzo' => 300, 'caratteristica1 => acciaio 1095', 'descrizione' => 'Una katana decorativa ispirata al drago.' , 'img' => 'immagini/yagyu.jpg'],
            ['id' => 5, 'nome' => 'Lama di Shisui', 'prezzo' => 800, 'caratteristica1 => ninjato professionale', 'descrizione' => 'Una lama leggendaria appartenente alla famiglia Shisui.' , 'img' => 'immagini/fukushima.jpg'],
            ['id' => 6, 'nome' => 'Wakizashi Base', 'prezzo' => 150, 'caratteristica1 => professionale', 'descrizione' => 'Un wakizashi utilizzato per l\'allenamento.' , 'img' => 'immagini/fukushima.jpg'],
            ['id' => 7, 'nome' => 'Tanto di Giada', 'prezzo' => 450, 'caratteristica1 => wow', 'descrizione' => 'Un tanto di giada utilizzato per l\'ornamento.' , 'img' => 'immagini/nobunaga.jpg'],
            ['id' => 8, 'nome' => 'Katana in Carbonio', 'prezzo' => 600, 'caratteristica1 => cabonio risoluto', 'descrizione' => 'Una katana realizzata in carbonio.' , 'img' => 'immagini/yagyu.jpg'],
            ['id' => 9, 'nome' => 'Lama Imperiale', 'prezzo' => 2500, 'caratteristica1 => assoluta', 'descrizione' => 'Una lama imperiale appartenente alla famiglia imperiale.' , 'img' => 'immagini/muraka.jpg'],
            ['id' => 10, 'nome' => 'Katana Sakura', 'prezzo' => 350, 'caratteristica1 => lama colorata', 'descrizione' => 'Una katana decorativa ispirata al ciliegio.' , 'img' => 'immagini/muraka.jpg'],
        ];

private $offerte = [
            ['id' => 1, 'nome' => 'Hakama', 'prezzo' => 80, 'descrizione' => 'Un hakama utilizzato per l\'allenamento.' , 'img' => 'immagini/fukushima.jpg'],
            ['id' => 2, 'nome' => 'Gi', 'prezzo' => 40, 'descrizione' => 'Un gi utilizzato per l\'allenamento.' , 'img' => 'immagini/nobunaga.jpg'],
            ['id' => 3, 'nome' => 'Bokken Allenamento', 'prezzo' => 40, 'descrizione' => 'Un bokken utilizzato per l\'allenamento.' , 'img' => 'immagini/muraka.jpg'],
            ['id' => 4, 'nome' => 'Katana del Drago', 'prezzo' => 250, 'descrizione' => 'Una katana decorativa ispirata al drago.' , 'img' => 'immagini/yagyu.jpg'],
            ['id' => 5, 'nome' => 'Lama di Shisui', 'prezzo' => 600, 'descrizione' => 'Una lama leggendaria appartenente alla famiglia Shisui.' , 'img' => 'immagini/fukushima.jpg'],
            ['id' => 6, 'nome' => 'Wakizashi Base', 'prezzo' => 120, 'descrizione' => 'Un wakizashi utilizzato per l\'allenamento.' , 'img' => 'immagini/fukushima.jpg'],
            ['id' => 7, 'nome' => 'Tanto di Giada', 'prezzo' => 350, 'descrizione' => 'Un tanto di giada utilizzato per l\'ornamento.' , 'img' => 'immagini/nobunaga.jpg'],
            ['id' => 8, 'nome' => 'Katana in Carbonio', 'prezzo' => 500, 'descrizione' => 'Una katana realizzata in carbonio.' , 'img' => 'immagini/yagyu.jpg'],
            ['id' => 9, 'nome' => 'Lama Imperiale', 'prezzo' => 2000, 'descrizione' => 'Una lama imperiale appartenente alla famiglia imperiale.' , 'img' => 'immagini/muraka.jpg'],
            ['id' => 10, 'nome' => 'Katana Sakura', 'prezzo' => 300, 'descrizione' => 'Una katana decorativa ispirata al ciliegio.' , 'img' => 'immagini/muraka.jpg'],
        ];



    public function welcome()
    {
        return view('welcome');
    }

    public function article()
    {
        return view('article');
    }

public function products($category)
{
    if ($category == 'katane-accessori') {
        $data = $this->katanaaccessori; // Qui metti l'array delle spade
        $title = "Katane e Accessori";
        $description = "Scopri tutte le nostre katane e accessori certificati!";
    } elseif ($category == 'arti-marziali') {
        $data = $this->artimarziali; // Qui l'array di Hakama, Gi, ecc.
        $title = "Arti Marziali";
        $description = "Scopri tutti i nostri prodotti certificati per le arti marziali!";
    } elseif ($category == 'offerte-novita') {
        $data = $this->offerte; // Qui l'array delle offerte
        $title = "Offerte e Novità";
        $description = "Scopri tutte le nostre offerte e non perderti tutte le nostre Novità!";
    } else {
        abort(404);
    }

    return view('products', [
        'offerte' => $data, 
        'titolo' => $title,
        'description' => $description
    ]);
}
    public function login()
    {
        return view('login');
    }
}


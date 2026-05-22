<?php

namespace App\Http\Controllers;

use App\Models\MartialArts;
use App\Models\Offers;
use App\Models\ProductKatanas;
use Illuminate\Http\Request;

class PublicController extends Controller
{

    public function welcome()
    {

        $items = ProductKatanas::latest()->take(4)->get();

        // Passiamo la variabile filtrata alla vista
        return view('welcome', compact('items'));
    }
    public function products($category)
    {
        if ($category == 'katana') {
            $items = ProductKatanas::all();
            $title = 'Scopri le nostre katane';
            $description = 'katane per ogni esigenza dalle Basics alle Superior,';

            $type = 'katana';
            $subcategories = [
                ['nome' => 'Basics', 'link' => '#'],
                ['nome' => 'Practical', 'link' => '#'],
                ['nome' => 'Performance', 'link' => '#'],
                ['nome' => 'Superior', 'link' => '#'],
                ['nome' => 'Damasco', 'link' => '#'],
                ['nome' => 'Daisho Set Katana', 'link' => '#'],
                ['nome' => 'Tanto', 'link' => '#'],
                ['nome' => 'wakizashi', 'link' => '#'],
                ['nome' => 'Alternative Special', 'link' => '#'],
            ];
            return view('products', ['items' => $items, 'title' => $title, 'description' => $description, 'type' => $type, 'subcategories' => $subcategories]);
        }

        if ($category == 'artimarziali') {
            $items = MartialArts::all();
            $title = 'Scopri i nostri prodotti per le arti marziali';
            $description = 'innumerevoli prodotti per la pratica delle arti marziali di qualità YariNoHanzo';

            $type = 'martial';
            $subcategories = [
                ['nome' => 'Iaido Gi', 'link' => '#'],
                ['nome' => 'Kendo Gi', 'link' => '#'],
                ['nome' => 'Hakama', 'link' => '#'],
                ['nome' => 'Ninjutsu Gi', 'link' => '#'],
                ['nome' => 'Aikido Gi', 'link' => '#'],
                ['nome' => 'Judo Gi', 'link' => '#'],
                ['nome' => 'Karate Gi', 'link' => '#'],
            ];

            return view('products', ['items' => $items, 'title' => $title, 'description' => $description, 'type' => $type, 'subcategories' => $subcategories]);
        }

        if ($category == 'offerte') {
            // Carichiamo le offerte con i prodotti collegati
            $items = Offers::with(['katana', 'martialArt'])->get();
            $title = 'Le nostre Offerte';
            $description = 'Innumerevoli offerte su tutti i prodotti YariNoHanzo';

            $subcategories = [
                ['nome' => 'Katana Kaizen', 'link' => '#'],
                ['nome' => 'Katana edizione 18° Anniversario', 'link' => '#'],
                ['nome' => 'Angolo delle occasioni', 'link' => '#'],
                ['nome' => 'Budospring2026', 'link' => '#'],
                ['nome' => 'ONI by YariNoHanzo - NOVITÀ 2025', 'link' => '#'],
            ];

            return view('offers', compact('items', 'title', 'description' , 'subcategories')); // Usiamo una vista specifica per le offerte
        }

        abort(404); // Se la categoria non esiste
    }

    public function article()
    {
        return view('article');
    }
    // fine welcome page

    // products page
    public function index()
    {
        // Recuperiamo le offerte caricando "al volo" i dati dei prodotti associati
        $offerte = Offers::with(['katana', 'martialArt'])->get();

        return view('home', compact('offerte'));
    }
}

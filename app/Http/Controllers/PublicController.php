<?php

namespace App\Http\Controllers;

use App\Models\MartialArts;
use App\Models\Offers;
use App\Models\ProductKatanas;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class PublicController extends Controller
{

    public function welcome()
    {

        $items = ProductKatanas::latest()->take(4)->get();

        // Passiamo la variabile filtrata alla vista
        return view('welcome', compact('items'));
    }

public function products($category, $subcategory_slug = null)
    {
        // 1. GESTIONE MACRO-CATEGORIA: KATANA
        if ($category == 'katana') {
            $description = 'Katane per ogni esigenza dalle Basics alle Superior di qualità YariNoHanzo';
            
            // Recuperiamo tutte le sottocategorie legate alle katane per la sidebar
            $subcategories = Subcategory::where('macro_categoria', 'katana')->get();

            // Se l'utente sta filtrando per una sottocategoria specifica
            if ($subcategory_slug) {
                $sub = Subcategory::where('slug', $subcategory_slug)->where('macro_categoria', 'katana')->firstOrFail();
                $items = ProductKatanas::where('subcategory_id', $sub->id)->get();
                $title = 'Katane - ' . $sub->nome;
            } else {
                // Altrimenti mostra tutte le katane
                $items = ProductKatanas::all();
                $title = 'Scopri le nostre katane';
            }

            $type = 'katana';
            return view('products', compact('items', 'title', 'description', 'type', 'subcategories'));
        }
        // OLD CODE
    // public function products($category)
    // {
    //     if ($category == 'katana') {
    //         $items = ProductKatanas::all();
    //         $title = 'Scopri le nostre katane';
    //         $description = 'katane per ogni esigenza dalle Basics alle Superior,';

    //         $type = 'katana';
    //         $subcategories = [
    //             ['nome' => 'Basics', 'link' => '#'],
    //             ['nome' => 'Practical', 'link' => '#'],
    //             ['nome' => 'Performance', 'link' => '#'],
    //             ['nome' => 'Superior', 'link' => '#'],
    //             ['nome' => 'Damasco', 'link' => '#'],
    //             ['nome' => 'Daisho Set Katana', 'link' => '#'],
    //             ['nome' => 'Tanto', 'link' => '#'],
    //             ['nome' => 'wakizashi', 'link' => '#'],
    //             ['nome' => 'Alternative Special', 'link' => '#'],
    //         ];
    //         return view('products', ['items' => $items, 'title' => $title, 'description' => $description, 'type' => $type, 'subcategories' => $subcategories]);
    //     }
// OLD CODE


// 2. GESTIONE MACRO-CATEGORIA: ARTICOLI MARZIALI
    if ($category == 'artimarziali') {
            $description = 'Innumerevoli prodotti per la pratica delle arti marziali di qualità YariNoHanzo';
            
            // Recuperiamo tutte le sottocategorie legate alle arti marziali per la sidebar
            $subcategories = Subcategory::where('macro_categoria', 'martial_arts')->get();

            // Se l'utente sta filtrando per una sottocategoria specifica
            if ($subcategory_slug) {
                $sub = Subcategory::where('slug', $subcategory_slug)->where('macro_categoria', 'martial_arts')->firstOrFail();
                $items = MartialArts::where('subcategory_id', $sub->id)->get();
                $title = 'Arti Marziali - ' . $sub->nome;
            } else {
                // Altrimenti mostra tutti i prodotti di arti marziali
                $items = MartialArts::all();
                $title = 'Scopri i nostri prodotti per le arti marziali';
            }

            $type = 'martial';
            return view('products', compact('items', 'title', 'description', 'type', 'subcategories'));
        }

        // OLD CODE
        // if ($category == 'artimarziali') {
        //     $items = MartialArts::all();
        //     $title = 'Scopri i nostri prodotti per le arti marziali';
        //     $description = 'innumerevoli prodotti per la pratica delle arti marziali di qualità YariNoHanzo';

        //     $type = 'martial';
        //     $subcategories = [
        //         ['nome' => 'Iaido Gi', 'link' => '#'],
        //         ['nome' => 'Kendo Gi', 'link' => '#'],
        //         ['nome' => 'Hakama', 'link' => '#'],
        //         ['nome' => 'Ninjutsu Gi', 'link' => '#'],
        //         ['nome' => 'Aikido Gi', 'link' => '#'],
        //         ['nome' => 'Judo Gi', 'link' => '#'],
        //         ['nome' => 'Karate Gi', 'link' => '#'],
        //     ];

        //     return view('products', ['items' => $items, 'title' => $title, 'description' => $description, 'type' => $type, 'subcategories' => $subcategories]);
        // }

        // OLD CODE

        if ($category == 'offerte') {
            $items = Offers::with(['katana', 'martialArt'])->get();
            $title = 'Le nostre Offerte';
            $description = 'Innumerevoli offerte su tutti i prodotti YariNoHanzo';
            
            // Passiamo tutte le sottocategorie per permettere di filtrare l'intero catalogo in offerta
            $subcategories = Subcategory::all();

            return view('offers', compact('items', 'title', 'description', 'subcategories'));
        }

        abort(404);
    }

    //     if ($category == 'offerte') {
    //         // Carichiamo le offerte con i prodotti collegati
    //         $items = Offers::with(['katana', 'martialArt'])->get();
    //         $title = 'Le nostre Offerte';
    //         $description = 'Innumerevoli offerte su tutti i prodotti YariNoHanzo';

    //         $subcategories = [
    //             ['nome' => 'Katana Kaizen', 'link' => '#'],
    //             ['nome' => 'Katana edizione 18° Anniversario', 'link' => '#'],
    //             ['nome' => 'Angolo delle occasioni', 'link' => '#'],
    //             ['nome' => 'Budospring2026', 'link' => '#'],
    //             ['nome' => 'ONI by YariNoHanzo - NOVITÀ 2025', 'link' => '#'],
    //         ];

    //         return view('offers', compact('items', 'title', 'description' , 'subcategories')); // Usiamo una vista specifica per le offerte
    //     }

    //     abort(404); 
    // }

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

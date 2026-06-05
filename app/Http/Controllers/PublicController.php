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

public function products(Request $request, $category, $subcategory_slug = null)
{
    // 1. Intercettiamo lo slug sia che arrivi dall'URL pulito, sia che arrivi dal form GET
    $slug = $subcategory_slug;



    // MACRO-CATEGORIA: KATANA
    if ($category == 'katana') {
        $description = 'Katane per ogni esigenza dalle Basics alle Superior di qualità YariNoHanzo';
        $subcategories = Subcategory::where('macro_categoria', 'katana')->get();

        $query = ProductKatanas::query();

        // Filtro Sottocategoria tramite ID reale
        if ($slug) {
            $sub = Subcategory::where('slug', $slug)->where('macro_categoria', 'katana')->first();
            if ($sub) {
                $query->where('subcategory_id', $sub->id);
                $title = 'Katane - ' . $sub->nome;
            } else {
                $title = 'Scopri le nostre katane';
            }
        } else {
            $title = 'Scopri le nostre katane';
        }

        // Filtro Prezzo
        $query->when($request->price_range, function ($q, $priceRange) {
            if ($priceRange == '100') {
                return $q->where('prezzo', '<=', 100);
            } elseif ($priceRange == '100-300') {
                return $q->whereBetween('prezzo', [100, 300]);
            } elseif ($priceRange == '300') {
                return $q->where('prezzo', '>', 300);
            }
        });

        // Filtro Acciaio
        $query->when($request->steel, function ($q, $steelArray) {
            return $q->where(function($subQuery) use ($steelArray) {
                foreach($steelArray as $steel) {
                    $subQuery->orWhere('acciaio', 'LIKE', '%' . $steel . '%');
                }
            });
        });

        // Ordinamento
        if ($request->filled('order_by') && in_array($request->order_by, ['asc', 'desc'])) {
            $query->orderBy('prezzo', $request->order_by);
        }

        $items = $query->get();
        $type = 'katana';

        return view('products', compact('items', 'title', 'description', 'type', 'subcategories', 'slug'));
    }

    // MACRO-CATEGORIA: ARTICOLI MARZIALI
    if ($category == 'martial' || $category == 'artimarziali') {
        $description = 'Innumerevoli prodotti per la prima delle arti marziali di qualità YariNoHanzo';
        $subcategories = Subcategory::where('macro_categoria', 'martial_arts')->get();

        $query = MartialArts::query();

        if ($slug) {
            $sub = Subcategory::where('slug', $slug)->where('macro_categoria', 'martial_arts')->first();
            if ($sub) {
                $query->where('subcategory_id', $sub->id);
                $title = 'Arti Marziali - ' . $sub->nome;
            } else {
                $title = 'Scopri i nostri prodotti per le arti marziali';
            }
        } else {
            $title = 'Scopri i nostri prodotti per le arti marziali';
        }

        // Filtro Prezzo
        $query->when($request->price_range, function ($q, $priceRange) {
            if ($priceRange == '100') {
                return $q->where('prezzo', '<=', 100);
            } elseif ($priceRange == '100-300') {
                return $q->whereBetween('prezzo', [100, 300]);
            } elseif ($priceRange == '300') {
                return $q->where('prezzo', '>', 300);
            }
        });

        // Filtro Materiale
        $query->when($request->material, function ($q, $materialArray) {
            return $q->where(function($subQuery) use ($materialArray) {
                foreach($materialArray as $material) {
                    $subQuery->orWhere('descrizione', 'LIKE', '%' . $material . '%');
                }
            });
        });

        if ($request->filled('order_by') && in_array($request->order_by, ['asc', 'desc'])) {
            $query->orderBy('prezzo', $request->order_by);
        }

        $items = $query->get();
        $type = 'martial';

        return view('products', compact('items', 'title', 'description', 'type', 'subcategories', 'slug'));
    }

    if ($category == 'offerte' || $category == 'offers') {
            return $this->offers($slug);
        }

        abort(404);
    }



    

        

    public function offers($slug = null)
{
    // Iniziamo la query sulle offerte
    $query = Offers::with(['katana', 'martialArt']);

    // Se l'utente ha cliccato su una sottocategoria specifica (es. "Budospring 2026")
    if ($slug) {
        $sub = Subcategory::where('slug', $slug)->where('macro_categoria', 'offerte')->first();
        if ($sub) {
            // Filtra i record della tabella offers in base all'ID della sottocategoria
            $query->where('subcategory_id', $sub->id);
            $title = 'Offerte - ' . $sub->nome;
        } else {
            $title = 'Le nostre Offerte';
        }
    } else {
        $title = 'Le nostre Offerte';
    }

    $items = $query->get();
    $description = 'Innumerevoli offerte esclusive e occasioni speciali YariNoHanzo';
    
    $subcategories = Subcategory::where('macro_categoria', 'offerte')->get();
    
    $type = 'offer'; 


    return view('offers', compact('items', 'title', 'description', 'subcategories', 'type', 'slug'));
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

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


    // logica search
    public function search(Request $request)
    {
        // Recuperiamo la parola inserita dall'utente
        $searched = $request->input('searched');

        // Cerca nelle Katane/Prodotti per nome (usiamo LIKE %parola%)
        $products = ProductKatanas::where('nome', 'LIKE', "%{$searched}%")->get();

        // Cerca nelle Arti Marziali per nome (se hai modelli separati)
        $martialArts = MartialArts::where('nome', 'LIKE', "%{$searched}%")->get();

        $offers = Offers::where('nome', 'LIKE', "%{$searched}%")->get();

        // Aggiungiamo 'offers' nel compact per mandarlo alla vista
        return view('search-results', compact('products', 'martialArts', 'offers', 'searched'));
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
                return $q->where(function ($subQuery) use ($steelArray) {
                    foreach ($steelArray as $steel) {
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
                return $q->where(function ($subQuery) use ($materialArray) {
                    foreach ($materialArray as $material) {
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
        // SE lo slug non arriva dall'URL pulito, controlliamo se arriva dal GET '?filtro='
        if (!$slug) {
            $slug = request('filtro');
        }

        // Iniziamo la query sulle offerte
        $query = Offers::with(['katana', 'martialArt']);

        if ($slug) {
            // Cerchiamo la sottocategoria nel DB tramite lo slug recuperato
            $sub = Subcategory::where('slug', $slug)->first();

            if ($sub) {
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

        // Recuperiamo le sottocategorie per la sidebar
        $subcategories = Subcategory::where('macro_categoria', 'offerte')->get();
        $type = 'offer';

        return view('offers', compact('items', 'title', 'description', 'subcategories', 'type', 'slug'));
    }



    public function showProduct($id)
    {
        // Cerca direttamente nella tabella delle katane
        $item = ProductKatanas::findOrFail($id);

        // Manda i dati alla vista 'article.blade.php'
        return view('article', compact('item'));
    }

    // 2. GESTISCE LE OFFERTE (Il "controller intelligente" di prima)
    public function showOffer($id)
    {
        $item = Offers::findOrFail($id);

        // Se è un'offerta relazionale legata a una katana
        if ($item->katana_id && !$item->nome) {
            $katana = ProductKatanas::find($item->katana_id);
            if ($katana) {
                $item->nome = $katana->nome;
                $item->descrizione = $katana->descrizione;
                $item->img = $katana->img;
                $item->prezzo = $katana->prezzo;
                $item->acciaio = $katana->acciaio;
                $item->larghezzalama = $katana->larghezzalama;
                $item->lunghezzalama = $katana->lunghezzalama;
                $item->lunghezzatsuka = $katana->lunghezzatsuka;
            }
        }
        // Se è legata a un articolo di arti marziali
        elseif ($item->martial_art_id && !$item->nome) {
            $art = \App\Models\MartialArts::find($item->martial_art_id);
            if ($art) {
                $item->nome = $art->nome;
                $item->descrizione = $art->descrizione;
                $item->img = $art->img;
                $item->prezzo = $art->prezzo;
                $item->materiale = $art->materiale;
            }
        }

        // Manda i dati strutturati alla STESSA vista 'article.blade.php'
        return view('article', compact('item'));
    }

    public function showMartialArt($id)
    {
        // Cerca direttamente nella tabella delle arti marziali
        $item = \App\Models\MartialArts::findOrFail($id);

        // Sfrutta la STESSA vista article.blade.php
        return view('article', compact('item'));
    }
}

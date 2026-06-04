<?php

namespace Database\Seeders;

use App\Models\Subcategory;
use App\Models\MartialArts;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductArtialMartsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        // 1. Recuperiamo le sottocategorie tramite il NOME reale 
        $subIaidoGi       = Subcategory::where('nome', 'Iaido Gi')->first();
        $subKendoGi       = Subcategory::where('nome', 'Kendo Gi')->first();
        $subHakama        = Subcategory::where('nome', 'Hakama')->first();
        $subNinjutsuGi    = Subcategory::where('nome', 'Ninjutsu Gi')->first();
        $subAikidoGi      = Subcategory::where('nome', 'Aikido Gi')->first();
        $subJudoGi        = Subcategory::where('nome', 'Judo Gi')->first();
        $subKarateGi      = Subcategory::where('nome', 'Karate Gi')->first();

        // Sottocategorie dei Bokken e Armi in legno
        $subBokkenRyuha   = Subcategory::where('nome', 'Ryuha')->first();
        $subStandard      = Subcategory::where('nome', 'Standard')->first();
        $subBudoguNingu   = Subcategory::where('nome', 'Budogu&Ningu')->first();
        $subBoJoHanbo     = Subcategory::where('nome', 'Bo Jo/Hanbo')->first(); // <-- Trova perfettamente "Bo Jo/Hanbo"
        $subYariNaginata  = Subcategory::where('nome', 'Yari/Naginata')->first(); // <-- Previene il prossimo potenziale errore su Yari/Naginata
        $subWenge         = Subcategory::where('nome', 'Wengè')->first();
        $subLignumVitae   = Subcategory::where('nome', 'Lignum Vitae')->first();

        // 2. Prepariamo l'array con i prodotti di Arti Marziali
        $martialArtsProducts = [
            [
                'nome' => 'Keikogi Iaido Elegance',
                'prezzo' => 85,
                'materiale' => 'Cotone e Poliestere',
                'descrizione' => 'Uniforme tradizionale per la pratica dello Iaido, leggera e resistente.',
                'img' => 'imgMartialArts/IAIDOKEIKOGI.jpg',
                'subcategory_id' => $subIaidoGi?->id
            ],
            [
                'nome' => 'Kendogi Master',
                'prezzo' => 90,
                'materiale' => '100% Cotone pesante',
                'descrizione' => 'Kendogi tinto in vero indaco, ideale per allenamenti intensi e competizioni.',
                'img' => 'imgMartialArts/IAIDOKEIKOGI.jpg',
                'subcategory_id' => $subKendoGi?->id
            ],
            [
                'nome' => 'Hakama Tradizionale Tetron',
                'prezzo' => 120,
                'materiale' => 'Tetron (Poliestere/Rayon)',
                'descrizione' => 'Hakama giapponese classica con pieghe permanenti, ideale per Kendo e Iaido.',
                'img' => 'imgMartialArts/hakama.jpg',
                'subcategory_id' => $subHakama?->id
            ],
            [
                'nome' => 'Shinobi Shozoku Ninjutsu',
                'prezzo' => 95,
                'materiale' => 'Cotone rinforzato',
                'descrizione' => 'Divisa completa da Ninjutsu inclusiva di giacca, pantalone, ghette e cappuccio.',
                'img' => 'imgMartialArts/immagini/NINJUTSUGI.jpg',
                'subcategory_id' => $subNinjutsuGi?->id
            ],
            [
                'nome' => 'Aikidogi Classic',
                'prezzo' => 70,
                'materiale' => '100% Cotone',
                'descrizione' => 'Giacca con tessitura a grana di riso specifica per le proiezioni e le prese dell\'Aikido.',
                'img' => 'imgMartialArts/immagini/AIKIDOSET.jpg',
                'subcategory_id' => $subAikidoGi?->id
            ],
            [
                'nome' => 'Judogi Competition',
                'prezzo' => 110,
                'materiale' => 'Cotone grana di riso pesante',
                'descrizione' => 'Gi omologato per competizioni di Judo, cuciture rinforzate sui punti di trazione.',
                'img' => 'imgMartialArts/immagini/JUDOGI.jpg',
                'subcategory_id' => $subJudoGi?->id
            ],
            [
                'nome' => 'Karategi Lightweight',
                'prezzo' => 45,
                'materiale' => 'Cotone leggero',
                'descrizione' => 'Ideale per il Kumite e per gli allenamenti estivi quotidiani.',
                'img' => 'imgMartialArts/immagini/KARATEGI.jpg',
                'subcategory_id' => $subKarateGi?->id
            ],
            [
                'nome' => 'Bokken Shinto Ryu',
                'prezzo' => 65,
                'materiale' => 'Quercia Bianca Giapponese',
                'descrizione' => 'Bokken bilanciato secondo le specifiche delle scuole tradizionali (Ryuha).',
                'img' => 'imgMartialArts/BOKKEN/BOKKENRYUHA.jpg',
                'subcategory_id' => $subBokkenRyuha?->id
            ],
            [
                'nome' => 'Bokken Standard Katana Profile',
                'prezzo' => 35,
                'materiale' => 'Quercia Rossa',
                'descrizione' => 'Bokken classico per principianti ed esperti, completo di tsuba e cupola in gomma.',
                'img' => 'imgMartialArts/BOKKEN/BOKKENSTANDARD.jpg',
                'subcategory_id' => $subStandard?->id
            ],
            [
                'nome' => 'Kunai e Shuriken Set',
                'prezzo' => 40,
                'materiale' => 'Gomma dura da allenamento',
                'descrizione' => 'Attrezzatura da pratica safe per lo studio delle armi da lancio del Ninjutsu.',
                'img' => 'imgMartialArts/BOKKEN/KUSARIGAMABUDOGU.jpg',
                'subcategory_id' => $subBudoguNingu?->id
            ],
            [
                'nome' => 'Bastone Bo Tradizionale',
                'prezzo' => 55,
                'materiale' => 'Legno di Frassino',
                'descrizione' => 'Bastone lungo cerimoniale e da combattimento, lunghezza standard 182 cm.',
                'img' => 'imgMartialArts/BOKKEN/BO.jpg',
                'subcategory_id' => $subBoJoHanbo?->id
            ],
            [
                'nome' => 'Naginata da Allenamento',
                'prezzo' => 130,
                'materiale' => 'Quercia e cima in Bambù',
                'descrizione' => 'Riproduzione fedele della celebre lancia giapponese per la pratica del Naginatado.',
                'img' => 'imgMartialArts/BOKKEN/NAGINATA.jpg',
                'subcategory_id' => $subYariNaginata?->id
            ],
            [
                'nome' => 'Bokken Custom Wengè',
                'prezzo' => 150,
                'materiale' => 'Legno Pregiato di Wengè',
                'descrizione' => 'Edizione limitata creata in legno scuro tropicale, venature uniche ad alta densità.',
                'img' => 'imgMartialArts/BOKKEN/BOKUTOLIGNUMVITAE.jpg',
                'subcategory_id' => $subWenge?->id
            ],
            [
                'nome' => 'Bokken Elite Lignum Vitae',
                'prezzo' => 220,
                'materiale' => 'Lignum Vitae (Guaiaco)',
                'descrizione' => 'Il bokken più pesante e indistruttibile della collezione, realizzato con il legno più duro al mondo.',
                'img' => 'imgMartialArts/BOKKEN/BOKKENLIGNUMVITAE1.jpg',
                'subcategory_id' => $subLignumVitae?->id
            ],
        ];

        // 3. Ciclo unico per salvare i prodotti nel DB
        foreach ($martialArtsProducts as $product) {
            MartialArts::create($product);
        }
    } // Chiude correttamente il metodo run()
} // Chiude correttamente la classe
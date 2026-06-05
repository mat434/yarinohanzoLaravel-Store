<?php

namespace Database\Seeders;

use App\Models\Subcategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SubcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subcategories = [
            // --- SOTTOCATEGORIE KATANA ---
            ['nome' => 'Basics', 'macro_categoria' => 'katana'],
            ['nome' => 'Practical', 'macro_categoria' => 'katana'],
            ['nome' => 'Performance', 'macro_categoria' => 'katana'],
            ['nome' => 'Superior', 'macro_categoria' => 'katana'],
            ['nome' => 'Damasco', 'macro_categoria' => 'katana'],
            ['nome' => 'Daisho Set Katana', 'macro_categoria' => 'katana'],
            ['nome' => 'Tanto', 'macro_categoria' => 'katana'],
            ['nome' => 'Wakizashi', 'macro_categoria' => 'katana'],
            ['nome' => 'Alternative Special', 'macro_categoria' => 'katana'],
            // Accessori e Manutenzione Katana
            ['nome' => 'Kit manutenzione', 'macro_categoria' => 'katana'],
            ['nome' => 'Sageo', 'macro_categoria' => 'katana'],
            ['nome' => 'Saya e tsuba', 'macro_categoria' => 'katana'],
            ['nome' => 'Mini katane e penne', 'macro_categoria' => 'katana'],
            ['nome' => 'Sacche e borse', 'macro_categoria' => 'katana'],
            ['nome' => 'Katana Kake (Supporti)', 'macro_categoria' => 'katana'],

            // --- SOTTOCATEGORIE ARTI MARZIALI ---
            // Abbigliamento
            ['nome' => 'Iaido Gi', 'macro_categoria' => 'martial_arts'],
            ['nome' => 'Kendo Gi', 'macro_categoria' => 'martial_arts'],
            ['nome' => 'Hakama', 'macro_categoria' => 'martial_arts'],
            ['nome' => 'Ninjutsu Gi', 'macro_categoria' => 'martial_arts'],
            ['nome' => 'Aikido Gi', 'macro_categoria' => 'martial_arts'],
            ['nome' => 'Judo Gi', 'macro_categoria' => 'martial_arts'],
            ['nome' => 'Karate Gi', 'macro_categoria' => 'martial_arts'],
            // Accessori e attrezzatura
            ['nome' => 'Set di uniformi', 'macro_categoria' => 'martial_arts'],
            ['nome' => 'Obi/Cinture', 'macro_categoria' => 'martial_arts'],
            ['nome' => 'Tabi, Tekou, Kyahan', 'macro_categoria' => 'martial_arts'],
            ['nome' => 'Zaini', 'macro_categoria' => 'martial_arts'],
            // Bokken e Armi in legno
            ['nome' => 'Ryuha', 'macro_categoria' => 'martial_arts'],
            ['nome' => 'Standard', 'macro_categoria' => 'martial_arts'],
            ['nome' => 'Budogu&Ningu', 'macro_categoria' => 'martial_arts'],
            ['nome' => 'Bo Jo/Hanbo', 'macro_categoria' => 'martial_arts'],
            ['nome' => 'Yari/Naginata', 'macro_categoria' => 'martial_arts'],
            ['nome' => 'Wengè', 'macro_categoria' => 'martial_arts'],
            ['nome' => 'Lignum Vitae', 'macro_categoria' => 'martial_arts'],

            // SOTTOCATEGORIE OFFERTE
            ['nome' => 'Katana Kaizen', 'macro_categoria' => 'offerte'],
            ['nome' => 'Katana Edizione 18Anniversario', 'macro_categoria' => 'offerte'],
            ['nome' => 'Budospring 2026', 'macro_categoria' => 'offerte'],
            ['nome' => 'Angolo delle occasioni', 'macro_categoria' => 'offerte'],
            ['nome' => 'ONI by YariNoHanzo', 'macro_categoria' => 'offerte'],
            ['nome' => 'YariNoHanzo HANDMADE', 'macro_categoria' => 'offerte'],
            ['nome' => 'Katana Shogun ELITE', 'macro_categoria' => 'offerte'],
        ];

        foreach ($subcategories as $sub) {
            Subcategory::create([
                'nome' => $sub['nome'],
                'slug' => Str::slug($sub['nome']), // Genera in automatico lo slug pulito (es: "iaido-gi")
                'macro_categoria' => $sub['macro_categoria']
            ]);
        }
    }
}

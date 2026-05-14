<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductOffersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Offers::create([
        'martial_art_id' => 1, 
        'prezzo_scontato' => 80
    ]);

    // Esempio: Mettere in offerta la Katana del Drago (ID 4 in product_katanas)
    \App\Models\Offers::create([
        'katana_id' => 4,
        'prezzo_scontato' => 250
    ]);
    }
}

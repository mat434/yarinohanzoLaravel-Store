<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('subcategories', function (Blueprint $table) {
        $table->id();
        $table->string('nome'); // Es: 'Superior', 'Basics', 'Tsuba', 'Judo Gi'
        $table->string('slug'); // Es: 'superior', 'basics', 'judo-gi' (comodo per le rotte)
        $table->string('macro_categoria'); // Ci serve per capire se appartiene a 'katana' o 'martial_arts'
        $table->timestamps();
        });

        Schema::table('product_katanas', function (Blueprint $table) {
        $table->foreign('subcategory_id')->references('id')->on('subcategories')->onDelete('cascade');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subcategories');
    }
};

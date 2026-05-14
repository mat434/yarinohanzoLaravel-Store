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
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->decimal('prezzo_scontato', 10, 2);
    // Colonne per il collegamento (possono essere nulle se l'offerta è dell'altra categoria)
            $table->unsignedBigInteger('katana_id')->nullable();
            $table->unsignedBigInteger('martial_art_id')->nullable();
    $table->timestamps();

    $table->foreign('katana_id')->references('id')->on('product_katanas')->onDelete('cascade');
    $table->foreign('martial_art_id')->references('id')->on('martial_arts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};

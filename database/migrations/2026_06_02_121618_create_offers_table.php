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
            $table->string('nome')->nullable();
            $table->integer('prezzo')->nullable(); // Prezzo originale
            $table->string('acciaio')->nullable();
            $table->integer('larghezzalama')->nullable();
            $table->integer('lunghezzalama')->nullable();
            $table->integer('lunghezzatsuka')->nullable();
            $table->string('materiale')->nullable(); 
            $table->text('descrizione')->nullable();
            $table->string('img')->nullable();
            $table->decimal('prezzo_scontato', 10, 2)->nullable(); // Prezzo scontato, se applicabile
            // Colonne per il collegamento (possono essere nulle se l'offerta è dell'altra categoria)
            $table->unsignedBigInteger('katana_id')->nullable();
            $table->unsignedBigInteger('martial_art_id')->nullable();
            // $table->unsignedBigInteger('subcategory_id');
            $table->foreign('katana_id')->references('id')->on('product_katanas')->onDelete('cascade');
            $table->foreign('martial_art_id')->references('id')->on('martial_arts')->onDelete('cascade');
            $table->foreignId('subcategory_id')->nullable()->constrained('subcategories')->onDelete('cascade');

            $table->timestamps();
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

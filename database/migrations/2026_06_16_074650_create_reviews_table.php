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
        Schema::create('reviews', function (Blueprint $table) {
        $table->id();
        // Collega la recensione all'utente (cancella le recensioni se l'utente viene eliminato)
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        
        // Se hai una tabella 'products' per le katane di serie, usiamo questo:
        $table->foreignId('product_id')->constrained('product_katanas')->onDelete('cascade');
        
        // Se le recensioni si applicano anche alle katane custom, potremmo usare una stringa 
        // o rendere il product_id nullable. Per ora lo teniamo legato ai prodotti di serie.

        $table->tinyInteger('rating')->unsigned(); // Voto da 1 a 5
        $table->text('comment')->nullable();       // Testo della recensione (opzionale)
        $table->timestamps();                      // Creato il / Aggiornato il
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};

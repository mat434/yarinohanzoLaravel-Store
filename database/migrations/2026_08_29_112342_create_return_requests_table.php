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
    Schema::create('return_requests', function (Blueprint $table) {
        $table->id();
        $table->foreignId('order_id')->constrained()->cascadeOnDelete();
        $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
        $table->string('return_method'); // domicilio | punto_postale
        $table->text('motivo')->nullable();
        $table->string('status')->default('richiesto'); // richiesto | in_lavorazione | completato | rifiutato
        $table->string('label_path')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */

    

    public function down(): void
    {
        Schema::dropIfExists('return_requests');
    }
};

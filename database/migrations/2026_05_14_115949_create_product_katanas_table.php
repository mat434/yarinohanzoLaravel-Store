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
        Schema::create('product_katanas', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('acciaio');
            $table->string('lunghezzalama');
            $table->string('lunghezzatsuka');
            $table->string('larghezzalama');
            $table->string('categoria');
            $table->text('descrizione');
            $table->decimal('prezzo', 8, 2);
            $table->string('img');
            $table->unsignedBigInteger('subcategory_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_katanas');
    }
};

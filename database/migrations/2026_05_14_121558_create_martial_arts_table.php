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
        Schema::create('martial_arts', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->decimal('prezzo', 8, 2);
            $table->string('materiale');
            $table->text('descrizione');
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
        Schema::dropIfExists('martial_arts');
    }
};

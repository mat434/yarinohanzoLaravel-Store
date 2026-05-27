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
        Schema::create('custom_katanas', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->integer('nagasa_lenght');
            $table->integer('tsuka_lenght');
            $table->integer('sori');
            $table->integer('motohaba');
            $table->string('kitae');    
            $table->string('bohi');
            $table->string('tsuba');
            $table->string('fuchikashira');
            $table->string('menuki');
            $table->string('habaki');
            $table->string('seppa');
            $table->string('samegawa');
            $table->string('stile_tsuka');
            $table->string('colore_tsuka');
            $table->string('tipo_saya');
            $table->string('colore_sageo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_katanas');
    }
};

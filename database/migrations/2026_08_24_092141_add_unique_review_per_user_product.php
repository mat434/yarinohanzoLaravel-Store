<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            // Un utente può lasciare una sola recensione per ogni combinazione prodotto+tipo
            $table->unique(['user_id', 'reviewable_id', 'reviewable_type'], 'unique_review_per_user_product');
        });
    }

    public function down(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropUnique('unique_review_per_user_product');
        });
    }
};
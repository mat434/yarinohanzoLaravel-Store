<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('custom_katanas', function (Blueprint $table) {
            $table->dropUnique('custom_katanas_email_unique');
        });
    }

    public function down(): void
    {
        Schema::table('custom_katanas', function (Blueprint $table) {
            $table->unique('email');
        });
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('nome');
            $table->string('email');
            $table->string('indirizzo');
            $table->decimal('total_price', 10, 2);
            $table->string('stripe_session_id')->nullable();
            $table->string('status')->default('in_lavorazione'); // in_lavorazione | reso_richiesto
            $table->text('reso_motivo')->nullable();
            $table->timestamp('reso_richiesto_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
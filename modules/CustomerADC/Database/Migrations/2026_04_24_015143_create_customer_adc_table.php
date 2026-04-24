<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('customer_adc', function (Blueprint $table) {
            $table->id();
            $table->string('fq_redi')->nullable();
            $table->string('id_customer')->nullable()->index(); // Indexamos para búsquedas rápidas
            $table->string('marca')->nullable();
            $table->string('no_serie')->nullable();
            $table->string('no_serial')->nullable();
            $table->string('no_activo')->nullable();
            $table->string('empresa')->nullable();
            $table->string('estado')->nullable();
            $table->string('tipo_activo')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customer_adc');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_class_3', function (Blueprint $table) {
            $table->id();
            $table->string('cl3_code', 25)->unique(); // Aumentado por si acaso
            $table->string('cl2_code', 18)->nullable(); // Padre (Categoría)
            $table->string('cl3_name', 100); // Aumentado para nombres largos
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_class_3');
    }
};

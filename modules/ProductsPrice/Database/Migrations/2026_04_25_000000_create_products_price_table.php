<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products_price', function (Blueprint $table) {
            $table->id();
            $table->string('lgnstreet1');
            $table->string('fecha_creacion');
            $table->string('categoria')->nullable();
            $table->string('marca')->nullable();
            $table->string('material');
            $table->string('descripcion')->nullable();
            $table->string('empaque')->nullable();
            $table->integer('ud_por_cj')->nullable();
            $table->string('iva')->nullable();
            
            // Precios Compra
            $table->decimal('precio_compra_und_sin_iva', 10, 2)->nullable();
            $table->decimal('precio_compra_und_con_iva', 10, 2)->nullable();
            $table->decimal('precio_compra_caja_sin_iva', 10, 2)->nullable();
            $table->decimal('precio_compra_caja_con_iva', 10, 2)->nullable();
            
            // Precios Venta
            $table->decimal('precio_venta_und_sin_iva', 10, 2)->nullable();
            $table->decimal('precio_venta_und_con_iva', 10, 2)->nullable();
            $table->decimal('precio_venta_caja_sin_iva', 10, 2)->nullable();
            $table->decimal('precio_venta_caja_con_iva', 10, 2)->nullable();
            
            $table->timestamps();

            // Clave única compuesta sugerida por el usuario
            $table->unique(['material', 'lgnstreet1'], 'unique_material_lgnstreet');
            
            // Índice para búsquedas por franquicia
            $table->index('lgnstreet1');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products_price');
    }
};

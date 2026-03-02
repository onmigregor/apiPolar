<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('discount_detail_products', function (Blueprint $table) {
            $table->id();
            $table->string('dlp_code', 10)->comment('Nº registro correlativo clave 1');
            $table->string('dis_code', 4)->comment('Clase de condición');
            $table->string('did_code', 10)->comment('Nº registro condición');
            $table->string('pro_code', 18)->comment('Número de material');
            $table->string('unt_code', 3)->comment('Unidad de medida');

            $table->string('dlp_required')->nullable();
            $table->decimal('dlp_discount', 11, 2)->nullable();
            $table->decimal('dlp_discount_percentage', 11, 2)->nullable();
            $table->decimal('dlp_discount_amount', 11, 2)->nullable();

            $table->decimal('dlp_required_quantity', 11, 2)->nullable();
            $table->decimal('dlp_required_quantity_amount', 11, 2)->nullable();
            $table->string('dlp_base_from_taken_for_discou')->nullable();
            $table->string('dlp_pallet_discount')->nullable();
            $table->decimal('dlp_minimum', 11, 2)->nullable();

            for ($i = 1; $i <= 5; $i++) {
                $table->decimal("dlp_quantity{$i}", 15, 2)->nullable()->comment("Valor base escala nivel {$i}");
                $table->decimal("dlp_min_discount{$i}", 11, 2)->nullable()->comment("Importe o proc nivel {$i}");
            }

            for ($i = 1; $i <= 6; $i++) {
                $table->decimal("dlp_max_discount{$i}", 11, 2)->nullable()->comment("Max importe proc nivel {$i}");
            }

            $table->decimal('dlp_global_discount_amount', 11, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('discount_detail_products');
    }
};

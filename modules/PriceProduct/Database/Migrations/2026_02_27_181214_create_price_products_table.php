<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('price_products', function (Blueprint $table) {
            $table->id();
            $table->string('prc_code', 18)->comment('Organización de ventas');
            $table->string('pro_code', 18)->comment('Número de material');
            $table->string('unt_code', 3)->comment('Unidad de medida para la condición');
            $table->date('ppr_date1')->comment('Inicio de validez de la condición');
            $table->decimal('ppr_price1_date1', 11, 2)->comment('Importe/porcentaje de condición');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('price_products');
    }
};

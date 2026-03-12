<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('product_units', function (Blueprint $table) {
            $table->id();
            $table->string('pro_code', 18)->comment('Número de material');
            $table->string('unt_code', 3)->comment('Unidad de medida base - FK to Unit');
            $table->string('pru_divide_by', 13)->nullable()->comment('Cantidad de componente (botellas)');
            $table->string('pru_bar_code', 20)->nullable()->comment('Código de barras de unidad');

            $table->unique(['pro_code', 'unt_code'], 'prod_unit_unique');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_units');
    }
};

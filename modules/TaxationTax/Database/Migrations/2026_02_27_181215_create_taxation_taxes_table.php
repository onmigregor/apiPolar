<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('taxation_taxes', function (Blueprint $table) {
            $table->id();
            $table->string('ttx_code', 18)->comment('Clave primaria SAP');
            $table->string('txn_code', 1)->comment('Clasificación fiscal para el deudor');
            $table->string('tax_code', 1)->comment('Clasificación fiscal para el material');
            $table->date('ttx_date1')->comment('Fecha actual del día de ejecución');
            $table->string('pro_code', 18)->comment('Número de material');
            $table->decimal('ttx_percent_date1', 11, 2)->comment('Importe/porcentaje de condición');
            $table->string('unt_code', 3)->comment('Unidad de medida base');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('taxation_taxes');
    }
};

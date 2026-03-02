<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('discount_details', function (Blueprint $table) {
            $table->id();
            $table->string('dis_code', 4)->comment('Clase de condición');
            $table->string('did_code', 10)->comment('Nº registro condición');
            $table->string('did_name', 20)->comment('Descripción');
            $table->string('rot_code_customer', 6)->nullable()->comment('Ruta');
            $table->string('cus_code', 10)->nullable()->comment('Número de cliente');
            $table->date('did_since')->nullable()->comment('Fin de validez del registro de condición');
            $table->date('did_until')->nullable()->comment('Inicio de validez de la condición');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('discount_details');
    }
};

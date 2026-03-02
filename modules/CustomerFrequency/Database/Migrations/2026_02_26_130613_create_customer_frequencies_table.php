<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('customer_frequencies', function (Blueprint $table) {
            $table->id();
            $table->string('fre_code', 2)->comment('Código clave frecuencia');
            $table->string('fre_name', 40)->comment('Descripción frecuencia');
            $table->string('fre_week1', 1)->comment('Frecuencia lunes');
            $table->string('fre_week2', 1)->comment('Frecuencia martes');
            $table->string('fre_week3', 1)->comment('Frecuencia miercoles');
            $table->string('fre_week4', 1)->comment('Frecuencia jueves');
            $table->string('fre_customer', 1)->comment('Frecuencia viernes');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('customer_frequencies');
    }
};

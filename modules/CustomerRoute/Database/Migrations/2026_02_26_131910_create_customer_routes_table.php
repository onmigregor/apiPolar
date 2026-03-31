<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('customer_routes', function (Blueprint $table) {
            $table->id();
            $table->string('rot_code', 20)->comment('Ruta');
            $table->string('cus_code', 20)->comment('Número de deudor');
            $table->string('fre_code', 20)->comment('Código clave frecuencia');
            $table->string('ctr_monday', 1)->nullable()->comment('Frecuencia lunes');
            $table->string('ctr_tuesday', 1)->nullable()->comment('Frecuencia martes');
            $table->string('ctr_wednesday', 1)->nullable()->comment('Frecuencia miercoles');
            $table->string('ctr_thursday', 1)->nullable()->comment('Frecuencia jueves');
            $table->string('ctr_friday', 1)->nullable()->comment('Frecuencia viernes');

// Llaves foráneas a nivel de BD removidas temporalmente

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('customer_routes');
    }
};

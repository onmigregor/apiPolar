<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('journeys', function (Blueprint $table) {
            $table->id();
            $table->string('jrn_code', 10)->comment('Lista de visitas');
            $table->string('rot_code', 6)->comment('Ruta');
            $table->date('jrn_date')->nullable()->comment('Fecha de ejecución de la lista de visitas');
            $table->string('jrn_dummy', 30)->nullable()->comment('Denominación plan/lista de visitas');
            $table->string('jrn_status', 20)->nullable()->comment('Status of Journey');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('journeys');
    }
};

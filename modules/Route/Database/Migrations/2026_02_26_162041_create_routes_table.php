<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('routes', function (Blueprint $table) {
            $table->id();
            $table->string('rot_code', 6)->comment('Ruta');
            $table->string('rot_name', 30)->comment('Denominación plan/lista de visitas');
            $table->string('lgn_code', 6)->comment('Ruta');
            $table->string('try_code', 10)->comment('Punto de destino de una ruta (ruta del FQ)');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('routes');
    }
};

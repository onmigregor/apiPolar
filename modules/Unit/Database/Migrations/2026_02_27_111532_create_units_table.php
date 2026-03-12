<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->string('unt_code', 3)->unique()->comment('Unidad de medida base');
            $table->string('unt_name', 10)->comment('Texto para la unidad de medida (máx. 10 posiciones)');
            $table->string('unt_nick', 3)->comment('Unidad medida alternativa p.unidad medida almacén');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('units');
    }
};

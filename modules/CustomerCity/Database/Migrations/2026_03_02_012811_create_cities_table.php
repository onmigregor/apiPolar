<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('customer_cities', function (Blueprint $table) {
            $table->id();
            $table->string('cit_code', 20)->comment('Código clave región');
            $table->string('cit_name', 20)->nullable()->comment('Descripción (estado, provincia, distrito)');
            $table->string('sta_code', 3)->nullable()->comment('Región (estado, provincia, distrito)');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('customer_cities');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('customer_regions', function (Blueprint $table) {
            $table->id();
            $table->string('cit_code', 2)->comment('Código clave región');
            $table->string('cit_name', 20)->comment('Descripción (estado, provincia, distrito)');
            $table->string('sta_code', 3)->comment('Región (estado, provincia, distrito)');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('customer_regions');
    }
};

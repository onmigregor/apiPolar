<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('discount_detail_routes', function (Blueprint $table) {
            $table->id();
            $table->string('rot_code', 6)->comment('Ruta');
            $table->string('dis_code', 4)->comment('Clase de condición');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('discount_detail_routes');
    }
};

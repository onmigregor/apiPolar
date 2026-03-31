<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('customer_infos', function (Blueprint $table) {
            $table->id();
            $table->string('cus_code', 20)->nullable()->comment('Número de deudor');
            $table->string('ift_code', 20)->nullable()->comment('Tipo de Licencia - Opción 1');
            $table->string('ctn_char_value', 100)->nullable()->comment('Numero de Licencia - Opcion 1');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('customer_infos');
    }
};

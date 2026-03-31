<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('customer_info_types', function (Blueprint $table) {
            $table->id();
            $table->string('ift_code', 20)->comment('Tipo de Licencia - Opción 1');
            $table->string('ift_name', 40)->nullable()->comment('Campo character (denominacion licencia)');
            $table->string('ift_char_type', 2)->nullable()->comment('Identificador de licencia');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('customer_info_types');
    }
};

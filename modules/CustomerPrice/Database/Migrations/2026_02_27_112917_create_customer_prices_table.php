<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('customer_prices', function (Blueprint $table) {
            $table->id();
            $table->string('rot_code', 20)->nullable()->comment('Ruta');
            $table->string('cus_code', 20)->nullable()->comment('Número de deudor');
            $table->string('prc_code', 20)->nullable()->comment('Centro suministrador');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('customer_prices');
    }
};

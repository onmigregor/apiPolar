<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('customer_branches', function (Blueprint $table) {
            $table->id();
            $table->string('tp2_code', 20)->comment('Código de ramo 1 (tipo cliente)');
            $table->string('tp2_name', 20)->nullable()->comment('Denominación (tipo cliente)');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('customer_branches');
    }
};

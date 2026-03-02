<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('taxations', function (Blueprint $table) {
            $table->id();
            $table->string('txn_code', 5)->comment('Clasificación fiscal para el material');
            $table->string('txn_name', 20)->comment('Denominación');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('taxations');
    }
};

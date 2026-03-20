<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->string('prm_code', 200)->primary();
            $table->string('prm_name')->nullable();
            $table->boolean('prm_can_be_disabled')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('promotions');
    }
};

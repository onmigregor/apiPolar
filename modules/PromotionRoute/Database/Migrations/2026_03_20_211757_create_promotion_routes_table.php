<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('promotion_routes', function (Blueprint $table) {
            $table->id();
            $table->string('rot_code', 50);
            $table->string('prm_code', 200);
            $table->timestamps();

            $table->foreign('prm_code')->references('prm_code')->on('promotions')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('promotion_routes');
    }
};

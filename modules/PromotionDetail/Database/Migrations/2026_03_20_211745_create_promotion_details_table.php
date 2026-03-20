<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('promotion_details', function (Blueprint $table) {
            $table->string('pdl_code', 200)->primary();
            $table->string('prm_code', 200);
            $table->string('pdl_name')->nullable();
            $table->date('pdl_since')->nullable();
            $table->dateTime('pdl_until')->nullable();
            $table->string('cus_code', 50)->nullable();
            $table->timestamps();

            $table->foreign('prm_code')->references('prm_code')->on('promotions')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('promotion_details');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('promotion_detail_products', function (Blueprint $table) {
            $table->string('prp_code', 200)->primary();
            $table->string('pdl_code', 200);
            $table->string('prm_code', 200);
            $table->string('pro_code', 50)->nullable();
            $table->string('unt_code', 10)->nullable();
            $table->decimal('prp_min_percentage1', 8, 3)->nullable();
            $table->decimal('prp_max_percentage1', 8, 3)->nullable();
            $table->decimal('prp_quantity1', 8, 3)->nullable();
            $table->string('cl1code', 50)->nullable();
            $table->timestamps();

            $table->foreign('pdl_code')->references('pdl_code')->on('promotion_details')->onDelete('cascade');
            $table->foreign('prm_code')->references('prm_code')->on('promotions')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('promotion_detail_products');
    }
};

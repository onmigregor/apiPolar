<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('pro_code', 18)->comment('Número de material');
            $table->string('pro_name', 40)->comment('Texto de material');
            $table->string('pro_short_name', 40)->nullable()->comment('Texto breve de material');
            $table->string('pro_organization', 4)->nullable()->comment('Organización de ventas');
            $table->string('unt_code', 3)->nullable()->comment('Unidad de medida base');
            $table->string('pro_bom_code', 18)->nullable()->comment('Número de material (lista de materiales)');
            $table->string('cl2_code', 18)->nullable()->comment('Jerarquía de productos');
            $table->date('pro_created_on')->nullable()->comment('Fecha de creación');
            $table->date('pro_modified_on')->nullable()->comment('Fecha de modificación');
            $table->decimal('pro_weight', 13, 3)->nullable()->comment('Peso bruto');
            $table->string('pro_unit_code_bom', 3)->nullable()->comment('Unidad de medida base (lista de materiales)');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
};

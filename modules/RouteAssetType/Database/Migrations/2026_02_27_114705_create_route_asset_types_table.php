<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('route_asset_types', function (Blueprint $table) {
            $table->id();
            $table->string('rot_code', 6)->comment('Ruta');
            $table->string('att_code', 10)->comment('Nº cliente / Asset Type');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('route_asset_types');
    }
};

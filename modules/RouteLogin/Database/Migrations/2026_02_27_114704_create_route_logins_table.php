<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('route_logins', function (Blueprint $table) {
            $table->id();
            $table->string('rot_code', 6)->comment('Ruta');
            $table->string('lgn_code', 6)->comment('Ruta de Login');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('route_logins');
    }
};

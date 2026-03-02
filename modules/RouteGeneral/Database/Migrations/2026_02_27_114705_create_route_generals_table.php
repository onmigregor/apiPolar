<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('route_generals', function (Blueprint $table) {
            $table->id();
            $table->string('rot_code', 6)->comment('Ruta');
            $table->date('gnl_date')->nullable()->comment('Fecha de ejecución de la lista de visitas');
            $table->integer('gnl_month_working_days')->nullable()->comment('Working days in month');
            $table->integer('gnl_days_up_to_date')->nullable()->comment('Days up to date');
            $table->string('gnl_next_working_day', 20)->nullable()->comment('Next working day');
            $table->string('jrn_code', 10)->nullable()->comment('Lista de visitas');
            $table->string('gnl_status', 20)->nullable()->comment('General status');
            $table->date('gnl_status_date')->nullable()->comment('Status date');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('route_generals');
    }
};

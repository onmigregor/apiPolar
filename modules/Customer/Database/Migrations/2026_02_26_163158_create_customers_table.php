<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('cus_code', 20)->comment('Número de deudor');
            $table->string('cus_name', 100)->nullable()->comment('Nombre 1 de deudor');
            $table->string('cus_business_name', 100)->nullable()->comment('Nombre 2 de deudor');
            $table->string('cus_duns', 100)->nullable()->comment('Coordenada Y del mapa');
            $table->string('cus_comm_id', 100)->nullable()->comment('Coordenada X del mapa');
            $table->string('tp1_code', 20)->nullable()->comment('Grupo de clientes 4 (segmento) - FK to CustomerGroup');
            $table->string('tp2_code', 20)->nullable()->comment('Código de ramo 1 (tipo cliente) - FK to CustomerBranch');
            $table->string('cit_code', 20)->nullable()->comment('Código clave región - FK to CustomerRegion');
            $table->string('txn_code', 20)->nullable()->comment('Clasificación fiscal para el deudor');
            $table->string('cus_phone', 50)->nullable()->comment('1º número de teléfono');
            $table->string('cus_fax', 50)->nullable()->comment('Nº telefax');
            $table->string('cus_street1', 100)->nullable()->comment('Nombre 1 (nombre dirección)');
            $table->string('cus_street2', 100)->nullable()->comment('Nombre 2 (nombre dirección)');
            $table->string('cus_street3', 100)->nullable()->comment('Nombre 3 (nombre dirección)');
            $table->string('cus_tax_id1', 50)->nullable()->comment('Número de identificación fiscal 1(rif)');
            $table->string('brc_code', 50)->nullable()->comment('Número de cliente del interlocutor (código del FQ)');
            $table->string('cus_latitude', 50)->nullable()->comment('Coordenada Y del mapa');
            $table->string('cus_longitude', 50)->nullable()->comment('Coordenada X del mapa');
            $table->string('prc_code_for_sale', 20)->nullable()->comment('Centro suministrador');
            $table->string('prc_code_for_return', 20)->nullable()->comment('Centro suministrador');
            $table->string('cus_contact_person', 100)->nullable()->comment('Nombre (persona contacto)');
            $table->string('cus_email', 255)->nullable()->comment('Dirección de correo electrónico');


            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('customers');
    }
};

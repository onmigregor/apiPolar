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
            $table->string('cus_code', 10)->comment('Número de deudor');
            $table->string('cus_name', 35)->comment('Nombre 1 de deudor');
            $table->string('cus_business_name', 35)->comment('Nombre 2 de deudor');
            $table->string('cus_duns', 40)->comment('Coordenada Y del mapa');
            $table->string('cus_comm_id', 40)->comment('Coordenada X del mapa');
            $table->string('tp1_code', 3)->comment('Grupo de clientes 4 (segmento) - FK to CustomerGroup');
            $table->string('tp2_code', 10)->comment('Código de ramo 1 (tipo cliente) - FK to CustomerBranch');
            $table->string('cit_code', 2)->comment('Código clave región - FK to CustomerRegion');
            $table->string('txn_code', 2)->comment('Clasificación fiscal para el deudor');
            $table->string('cus_phone', 16)->comment('1º número de teléfono');
            $table->string('cus_fax', 16)->comment('Nº telefax');
            $table->string('cus_street1', 40)->comment('Nombre 1 (nombre dirección)');
            $table->string('cus_street2', 40)->comment('Nombre 2 (nombre dirección)');
            $table->string('cus_street3', 40)->comment('Nombre 3 (nombre dirección)');
            $table->string('cus_tax_id1', 16)->comment('Número de identificación fiscal 1(rif)');
            $table->string('brc_code', 10)->comment('Número de cliente del interlocutor (código del FQ)');
            $table->string('cus_latitude', 40)->comment('Coordenada Y del mapa');
            $table->string('cus_longitude', 40)->comment('Coordenada X del mapa');
            $table->string('prc_code_for_sale', 4)->comment('Centro suministrador');
            $table->string('prc_code_for_return', 4)->comment('Centro suministrador');
            $table->string('cus_contact_person', 35)->comment('Nombre (persona contacto)');
            $table->string('cus_email', 241)->comment('Dirección de correo electrónico');


            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('customers');
    }
};

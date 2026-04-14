<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Regiones
        Schema::create('companies_regions', function (Blueprint $blueprint) {
            $blueprint->string('reg_code', 10)->primary();
            $blueprint->string('reg_name', 100)->nullable();
            $blueprint->timestamps();
        });

        // 2. Sucursales (Branches)
        Schema::create('companies_branches', function (Blueprint $blueprint) {
            $blueprint->string('brc_code', 10)->primary();
            $blueprint->string('brc_name', 100)->nullable();
            $blueprint->string('brc_general_header1', 100)->nullable();
            $blueprint->string('reg_code', 10)->nullable();
            $blueprint->timestamps();
        });

        // 3. Logins (Usuarios)
        Schema::create('companies_logins', function (Blueprint $blueprint) {
            $blueprint->string('lgn_code', 20)->primary();
            $blueprint->string('lgn_name', 100)->nullable();
            $blueprint->string('brc_code', 10)->nullable();
            $blueprint->timestamps();
        });

        // 4. Territorios
        Schema::create('companies_territories', function (Blueprint $blueprint) {
            $blueprint->string('try_code', 50)->primary();
            $blueprint->string('brc_code', 10)->nullable();
            $blueprint->string('lgn_code', 20)->nullable();
            $blueprint->string('try_name', 150)->nullable();
            $blueprint->timestamps();
        });

        // 5. Relación Login-Branch (Pivot)
        Schema::create('companies_login_branches', function (Blueprint $blueprint) {
            $blueprint->id();
            $blueprint->string('lgn_code', 20);
            $blueprint->string('brc_code', 10);
            $blueprint->timestamps();
        });

        // 6. Relación Crew-Login
        Schema::create('companies_crew_logins', function (Blueprint $blueprint) {
            $blueprint->id();
            $blueprint->string('crw_code', 20);
            $blueprint->string('lgn_code', 20);
            $blueprint->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies_crew_logins');
        Schema::dropIfExists('companies_login_branches');
        Schema::dropIfExists('companies_territories');
        Schema::dropIfExists('companies_logins');
        Schema::dropIfExists('companies_branches');
        Schema::dropIfExists('companies_regions');
    }
};

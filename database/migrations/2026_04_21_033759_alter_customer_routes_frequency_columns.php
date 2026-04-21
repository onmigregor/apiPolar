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
        Schema::table('customer_routes', function (Blueprint $table) {
            // Ampliar los días existentes a 3 caracteres (o más)
            $table->string('ctr_monday', 3)->nullable()->change();
            $table->string('ctr_tuesday', 3)->nullable()->change();
            $table->string('ctr_wednesday', 3)->nullable()->change();
            $table->string('ctr_thursday', 3)->nullable()->change();
            $table->string('ctr_friday', 3)->nullable()->change();

            // Agregar sábado y domingo (si no existen)
            if (!Schema::hasColumn('customer_routes', 'ctr_saturday')) {
                $table->string('ctr_saturday', 3)->nullable()->after('ctr_friday');
            }
            if (!Schema::hasColumn('customer_routes', 'ctr_sunday')) {
                $table->string('ctr_sunday', 3)->nullable()->after('ctr_saturday');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customer_routes', function (Blueprint $table) {
            $table->string('ctr_monday', 1)->nullable()->change();
            $table->string('ctr_tuesday', 1)->nullable()->change();
            $table->string('ctr_wednesday', 1)->nullable()->change();
            $table->string('ctr_thursday', 1)->nullable()->change();
            $table->string('ctr_friday', 1)->nullable()->change();

            if (Schema::hasColumn('customer_routes', 'ctr_saturday')) {
                $table->dropColumn('ctr_saturday');
            }
            if (Schema::hasColumn('customer_routes', 'ctr_sunday')) {
                $table->dropColumn('ctr_sunday');
            }
        });
    }
};

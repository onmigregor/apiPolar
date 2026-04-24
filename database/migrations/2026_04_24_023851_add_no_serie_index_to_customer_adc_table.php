<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $indexExists = DB::select("SHOW INDEX FROM customer_adc WHERE Key_name = 'customer_adc_no_serie_index'");
        
        if (count($indexExists) === 0) {
            Schema::table('customer_adc', function (Blueprint $table) {
                $table->index('no_serie');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        try {
            Schema::table('customer_adc', function (Blueprint $table) {
                $table->dropIndex(['no_serie']);
            });
        } catch (\Exception $e) {}
    }
};

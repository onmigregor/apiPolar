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
        Schema::table('products', function (Blueprint $table) {
            $table->string('pro_barcode', 50)->nullable()->after('pro_short_name');
            $table->string('cl4_code', 20)->nullable()->after('cl3_code');
            $table->string('pro_return_allowed', 1)->nullable()->after('cl4_code');
            $table->string('pro_damage_returns_allowed', 1)->nullable()->after('pro_return_allowed');
            $table->string('pro_available_for_sale', 1)->nullable()->after('pro_damage_returns_allowed');
            $table->string('pro_customer_inventory_allowed', 1)->nullable()->after('pro_available_for_sale');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
};

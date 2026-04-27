<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Update product_class4s table
        Schema::table('product_class4s', function (Blueprint $table) {
            $table->string('cl4_code', 50)->change();
            $table->string('brand_code', 20)->nullable()->after('cl4_name');
            $table->string('segment_code', 10)->nullable()->after('brand_code');
        });

        // 2. Update products table
        Schema::table('products', function (Blueprint $table) {
            $table->string('cl4_code', 50)->change();
            $table->string('brand_code', 20)->nullable()->after('cl4_code');
            $table->string('segment_code', 10)->nullable()->after('brand_code');
        });
    }

    public function down(): void
    {
        Schema::table('product_class4s', function (Blueprint $table) {
            $table->dropColumn(['brand_code', 'segment_code']);
        });

        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['brand_code', 'segment_code']);
        });
    }
};

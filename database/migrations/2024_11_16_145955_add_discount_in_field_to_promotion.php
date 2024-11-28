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
        Schema::table('promotions', function (Blueprint $table) {
            $table->integer('discountValue')->default(0)->notNullable();
            $table->string('discountType', 10)->notNullable();
            $table->integer('maxDiscountValue')->notNullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('promotions', function (Blueprint $table) {
            Schema::dropColumn(['discountValue', 'discountType', 'maxDiscountValue']);
        });
    }
};

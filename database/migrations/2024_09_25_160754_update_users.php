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
        Schema::table('users', function (Blueprint $table) {
            $table->string('province_id', 10)->nullable()->after('address');
            $table->string('district_id', 10)->nullable()->after('province_id');
            $table->string('ward_id', 10)->nullable()->after('district_id');
            $table->dateTime('birthday')->nullable()->after('ward_id');
            $table->string('image')->nullable()->after('birtday');
            $table->text('user_agent')->nullable()->after('image');
            $table->text('ip')->nullable()->after('user_agent');
            $table->integer('user_catalogue_id')->default(2);
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};

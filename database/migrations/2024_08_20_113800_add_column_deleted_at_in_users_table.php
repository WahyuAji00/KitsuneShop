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
            $table->dateTime('deleted_at')->nullable();
        });
        Schema::table('products', function (Blueprint $table) {
            $table->dateTime('deleted_at')->nullable();
        });
        Schema::table('sales', function (Blueprint $table) {
            $table->dateTime('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dateTime('deleted_at')->nullable();
        });
        Schema::table('products', function (Blueprint $table) {
            $table->dateTime('deleted_at')->nullable();
        });
        Schema::table('sales', function (Blueprint $table) {
            $table->dateTime('deleted_at')->nullable();
        });
    }
};

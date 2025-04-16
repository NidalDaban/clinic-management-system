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
        Schema::table('appointment', function (Blueprint $table) {
            $table->unsignedBigInteger('doctor_id')->nullable()->change();
            $table->unsignedBigInteger('psychologist_id')->nullable()->change();
            $table->unsignedBigInteger('secretary_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->unsignedBigInteger('doctor_id')->nullable(false)->change();
            $table->unsignedBigInteger('psychologist_id')->nullable(false)->change();
            $table->unsignedBigInteger('secretary_id')->nullable(false)->change();
        });
    }
};

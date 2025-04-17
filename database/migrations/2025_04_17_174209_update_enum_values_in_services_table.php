<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('services', function (Blueprint $table) {
            DB::statement("ALTER TABLE services MODIFY COLUMN type ENUM('therapy', 'consultation')");

            DB::table('services')->where('type', 'doctor')->update(['type' => 'therapy']);
            DB::table('services')->where('type', 'psychologist')->update(['type' => 'consultation']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            DB::statement("ALTER TABLE services MODIFY COLUMN type ENUM('doctor', 'psychologist')");
            DB::table('services')->where('type', 'therapy')->update(['type' => 'doctor']);
            DB::table('services')->where('type', 'consultation')->update(['type' => 'psychologist']);
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE users MODIFY role ENUM('user', 'patientDoctor', 'patientPsychologist', 'doctor', 'psychologist', 'admin', 'secretary') DEFAULT 'user'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE users MODIFY role ENUM('patient', 'doctor', 'psychologist', 'admin', 'secretary') DEFAULT 'patient'");
    }
};

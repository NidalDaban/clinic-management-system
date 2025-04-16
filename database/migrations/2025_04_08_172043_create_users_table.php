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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 25)->nullable();
            $table->string('second_name', 25)->nullable();
            $table->string('middle_name', 25)->nullable();
            $table->string('last_name', 25)->nullable();
            $table->enum('gender', ['male', 'female'])->default('male');
            $table->date('date_of_birth')->nullable();
            $table->boolean('is_marid')->nullable();
            $table->string('job_title')->nullable();
            $table->string('image_path')->nullable();
            $table->string('phone', 15)->nullable();
            $table->string('address', 255)->nullable();
            $table->foreignId('country_id')->constrained()->onDelete('cascade')->nullable();
            $table->string('email', 50)->unique();
            $table->string('password', 255);
            $table->text('chronic_disease')->nullable();
            $table->enum('role', ['patient', 'doctor', 'psychologist', 'admin', 'secretary'])->default('patient');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

<?php

use App\Enums\DayOfWeek;
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
        Schema::create('daily_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('doctor_id')
                ->nullable()
                ->constrained('users')
                ->onDelete('cascade');
            $table->foreignId('psychologist_id')
                ->nullable()
                ->constrained('users')
                ->onDelete('cascade');
            $table->enum('day_of_week', DayOfWeek::values());
            $table->timestamps();

            // Prevent duplicate days for the same professional
            $table->unique(['doctor_id', 'day_of_week']);
            $table->unique(['psychologist_id', 'day_of_week']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_schedules');
    }
};

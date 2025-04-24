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
        Schema::create('daily_schedule_slots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('daily_schedule_id')
                ->constrained('daily_schedules')
                ->onDelete('cascade');
            $table->time('start_time');
            $table->time('end_time');
            $table->timestamps();

            $table->unique(
                ['daily_schedule_id', 'start_time', 'end_time'],
                'daily_slots_unique'
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_schedule_slots');
    }
};
 
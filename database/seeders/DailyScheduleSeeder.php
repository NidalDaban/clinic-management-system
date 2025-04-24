<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DailyScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $doctor = \App\Models\User::where('role', 'doctor')->first();
        $psychologist = \App\Models\User::where('role', 'psychologist')->first();

        // Create weekly schedule for doctor
        foreach (['Monday', 'Wednesday', 'Friday'] as $day) {
            $schedule = \App\Models\DailySchedule::create([
                'doctor_id' => $doctor->id,
                'day_of_week' => $day
            ]);

            $schedule->slots()->createMany([
                ['start_time' => '09:00', 'end_time' => '10:00'],
                ['start_time' => '14:00', 'end_time' => '15:00']
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        User::create([
            'first_name' => 'John',
            'last_name' => 'Smith',
            'email' => 'doctor@clinic.com',
            'password' => bcrypt('password'),
            'role' => 'doctor'
        ]);
        
        User::create([
            'first_name' => 'Jane',
            'last_name' => 'Johnson',
            'email' => 'psychologist@clinic.com',
            'password' => bcrypt('password'),
            'role' => 'psychologist'
        ]);
    
        // Create 10 patients
        User::factory(10)->create(['role' => 'patient']);
    }
}

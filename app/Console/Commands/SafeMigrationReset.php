<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SafeMigrationReset extends Command
{
    protected $signature = 'migrate:safe-reset';
    protected $description = 'Safely reset migrations with proper foreign key handling';

    public function handle()
    {
        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $this->info('Foreign key checks disabled');

        // Get all tables in reverse dependency order
        $tables = [
            'daily_schedule_slots',
            'daily_schedules',
            'payments',
            'appointments',
            'services',
            'reviews',
            'users',
            'countries',
            'personal_access_tokens',
            'failed_jobs',
            'password_reset_tokens',
        ];

        // Drop tables in proper order
        foreach ($tables as $table) {
            if (Schema::hasTable($table)) {
                Schema::drop($table);
                $this->info("Dropped table: {$table}");
            }
        }

        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $this->info('Foreign key checks enabled');
        $this->info('All tables dropped successfully');

        return 0;
    }
}
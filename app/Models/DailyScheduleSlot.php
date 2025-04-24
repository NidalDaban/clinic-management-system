<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyScheduleSlot extends Model
{
    use HasFactory;

    protected $fillable = ['daily_schedule_id', 'start_time', 'end_time'];

    public function schedule()
    {
        return $this->belongsTo(DailySchedule::class, 'daily_schedule_id');
    }
}

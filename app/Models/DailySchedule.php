<?php

namespace App\Models;

use App\Enums\DayOfWeek;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailySchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'doctor_id',
        'psychologist_id',
        'day_of_week'
    ];

    protected $casts = [
        'day_of_week' => DayOfWeek::class,
    ];

    public function slots()
    {
        return $this->hasMany(DailyScheduleSlot::class);
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function psychologist()
    {
        return $this->belongsTo(User::class, 'psychologist_id');
    }

    public function scopeForUser($query, $user)
    {
        return $query->where(function ($q) use ($user) {
            $q->where('doctor_id', $user->id)
                ->orWhere('psychologist_id', $user->id);
        });
    }
}

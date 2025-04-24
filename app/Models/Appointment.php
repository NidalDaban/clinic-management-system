<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $table = 'appointment';

    protected $fillable = [
        'patient_id',
        'doctor_id',
        'psychologist_id',
        'secretary_id',
        'appointment_datetime',
        'attends',
        'addintional_note',
        'status',
        'payment_id',
        'service_id',
        'zoom_meeting_url',
    ];

    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function psychologist()
    {
        return $this->belongsTo(User::class, 'psychologist_id');
    }

    public function secretary()
    {
        return $this->belongsTo(User::class, 'secretary_id');
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}

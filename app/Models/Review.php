<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['doctor_id', 'patient_id', 'psychologist_id', 'ratings', 'comment'];


    public function patient() {
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function doctor () {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function psychologist () {
        return $this->belongsTo(User::class, 'psychologist_id');
    }
}

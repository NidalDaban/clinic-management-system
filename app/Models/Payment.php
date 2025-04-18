<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = ['total_amount', 'method', 'additional_note'];

    public function appointment()
    {
        return $this->hasOne(Appointment::class);
    }
}

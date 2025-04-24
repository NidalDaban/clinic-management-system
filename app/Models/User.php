<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const ROLE_USER = 'user';
    const ROLE_PATIENT_DOCTOR = 'patientDoctor';
    const ROLE_PATIENT_PSYCHOLOGIST = 'patientPsychologist';
    const ROLE_DOCTOR = 'doctor';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'second_name',
        'middle_name',
        'last_name',
        'gender',
        'date_of_birth',
        'is_marid',
        'job_title',
        'image_path',
        'phone',
        'address',
        'chronic_disease',
        'doctor_discription',
        'country_id',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function isPsychologist()
    {
        return $this->role === 'psychologist';
    }

    public function isDoctor()
    {
        return $this->role === 'doctor';
    }

    public function isPatient()
    {
        return $this->role === 'patientPsychologist' || $this->role === 'patientDoctor';
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isSecretary()
    {
        return $this->role === 'secretary';
    }

    // public function scopePsychologists($query)
    // {
    //     return $query->where('role', 'psychologist');
    // }

    public function doctorReviews()
    {
        return $this->hasMany(Review::class, 'doctor_id');
    }

    public function psychologistReviews()
    {
        return $this->hasMany(Review::class, 'psychologist_id');
    }

    public function reviewsRecieved()
    {
        return $this->hasMany(Review::class, 'doctor_id');
    }

    public function getRatingAttribute()
    {
        return $this->reviewsRecieved()->avg('ratings');
    }

    public function getReviewsCountAttribute()
    {
        return $this->reviewsRecieved()->count();
    }

    public function latestReview()
    {
        return $this->reviewsRecieved()->latest()->first();
    }

    public function reviewsGiven()
    {
        return $this->hasMany(Review::class, 'patient_id');
    }

    public function getPsychologistRatingAttribute()
    {
        return $this->psychologistReviews()->avg('ratings');
    }

    public function getPsychologistReviewsCountAttribute()
    {
        return $this->psychologistReviews()->count();
    }

    public function getLatestPsychologistReviewAttribute()
    {
        return $this->psychologistReviews()->latest()->first();
    }

    public function doctor()
    {
        return $this->hasMany(Appointment::class, 'doctor_id');
    }

    public function patient()
    {
        return $this->hasMany(Appointment::class, 'patient_id');
    }

    public function secretary()
    {
        return $this->hasMany(Appointment::class, 'secretary_id');
    }

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->second_name} {$this->middle_name} {$this->last_name}";
    }

    public function country()
    {
        return $this->belongsTo(countries::class);
    }

    public function dailySchedules()
    {
        return $this->hasMany(DailySchedule::class, 'doctor_id')
            ->orWhere('psychologist_id', $this->id);
    }
}

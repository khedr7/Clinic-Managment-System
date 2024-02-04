<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, SoftDeletes;
    use InteractsWithMedia, HasRoles;

    const PATH = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'email', 'password', 'address',
        'phone', 'role', 'gender', 'birthday', 'specialization_id'
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
        'name'              => 'string',
        'email'             => 'string',
        'address'           => 'string',
        'phone'             => 'integer',
        'gender'            => 'string',
        'role'              => 'string',
        'birthday'          => 'date',
        'specialization_id' => 'integer',
        'email_verified_at' => 'datetime',
    ];

    public function getImageAttribute()
    {
        if ($this->getMedia('image')->first())
            return $this->getMedia('image')->first()->getFullUrl();
        return null;
    }

    protected $appends = ['image'];

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function doctorAppointments()
    {
        return $this->hasMany(Appointment::class, 'doctor_id');
    }

    public function doctorSchedules()
    {
        return $this->hasMany(DoctorSchedule::class, 'doctor_id');
    }

    public function specialization()
    {
        return $this->belongsTo(Specialization::class, 'specialization_id', 'id');
    }
}

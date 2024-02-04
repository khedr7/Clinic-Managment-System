<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'day', 'start_time', 'end_time', 'doctor_id', 'medical_session_time'
    ];

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Appointment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'date', 'user_id', 'doctor_id', 'status', 'note',
    ];

    protected $casts = [
        'date'      => 'datetime',
        'user_id'   => 'integer',
        'doctor_id' => 'integer',
        'status'    => 'string',
        'note'      => 'string',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id', 'id');
    }

    public function scopeApp($query)
    {
        $auth = User::where('id', Auth::id())->first();

        if ($auth->role == 'admin') {
            $newQuery = $query;
        } elseif ($auth->role == 'doctor') {
            $newQuery = $query->where('doctor_id', $auth->id);
        } elseif ($auth->role == 'user') {
            $newQuery = $query->where('user_id', $auth->id);
        }

        $newQuery = $query
            ->when(request()->has('user_id'), function ($query) {
                return $query->where('user_id', request()->user_id);
            })

            ->when(request()->has('status'), function ($query) {
                return $query->where('status', request()->status);
            })

            ->when(request()->specialization_id, function ($query) {
                return $query->whereHas('doctor', function ($query) {
                    $query->where('specialization_id', request()->specialization_id);
                });
            })

            ->when(request()->search, function ($query) {
                return $query->WhereHas('doctor', function ($query) {
                    $query->where(DB::raw("lower(name)"), 'like', '%' . strtolower(request()->search) . '%')
                        ->orWhereHas('specialization', function ($query) {
                            $query->where(DB::raw("lower(title)"), 'like', '%' . strtolower(request()->search) . '%')
                                ->orWhere("title->ar", 'like', '%' . request()->search . '%');
                        });
                })
                    ->orWhereHas('user', function ($query) {
                        $query->where('name', 'like', '%' . strtolower(request()->search) . '%');
                    })
                    ->orWhere(DB::raw("lower(status)"), 'like', '%' . strtolower(request()->search) . '%');
            });

        return $newQuery->get();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    /** @use HasFactory<\Database\Factories\AppointmentFactory> */
    use HasFactory;

    protected $guarded = [];

    protected static function booted()
    {
        static::addGlobalScope('admin_scope', function (Builder $query) {
            if (auth()->check() && auth()->user()->admin != 1) {
                $query->where('clinic_id', auth()->user()->clinic_id);
            }
        });
    }

    protected $casts = [
        'date' => 'datetime',
    ];
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}

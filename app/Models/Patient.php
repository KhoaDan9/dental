<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    /** @use HasFactory<\Database\Factories\PatientFactory> */
    use HasFactory;

    protected $guarded = [];


    protected $casts = [
        'medical_history' => 'array',
        'date' => 'datetime',
    ];

    protected static function booted()
    {
        static::addGlobalScope('admin_scope', function (Builder $query) {
            if (auth()->check() && auth()->user()->admin != 1) {
                $query->where('clinic_id', auth()->user()->clinic_id);
            }
        });
    }

    public function asJson($value, $options = 0)
    {
        // Thêm tùy chọn JSON_UNESCAPED_UNICODE để giữ ký tự có dấu
        return json_encode($value, $options | JSON_UNESCAPED_UNICODE);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function clinic()
    {
        return $this->belongsTo(Clinic::class);
    }

    public function patientServices()
    {
        return $this->hasMany(PatientService::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function patientPrescriptions()
    {
        return $this->hasMany(PatientPrescription::class);
    }
    public function patientPayments()
    {
        return $this->hasMany(PatientPayment::class);
    }

    public function patientReminders()
    {
        return $this->hasMany(PatientReminder::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clinic extends Model
{
    /** @use HasFactory<\Database\Factories\ClinicFactory> */
    use HasFactory;

    public $incrementing = false; // Không dùng auto-increment
    protected $keyType = 'string'; // Kiểu khóa chính là string

    protected $guarded = [];

    protected static function booted()
    {
        static::addGlobalScope('admin_scope', function (Builder $query) {
            if (auth()->check() && auth()->user()->admin != 1) {
                $query->where('id', auth()->user()->clinic_id);
            }
        });
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function patients()
    {
        return $this->hasMany(Patient::class);
    }

    public function serviceGroups()
    {
        return $this->hasMany(ServiceGroup::class);
    }

    public function suppliers()
    {
        return $this->hasMany(Supplier::class);
    }
    public function patientPayments()
    {
        return $this->hasMany(PatientPayment::class);
    }

    public function fundingSources()
    {
        return $this->hasMany(FundingSource::class);
    }
}

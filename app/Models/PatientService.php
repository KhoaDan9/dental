<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientService extends Model
{
    /** @use HasFactory<\Database\Factories\PatientServiceFactory> */
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'date' => 'datetime', 
    ];


    public function patient(){
        return $this->belongsTo(Patient::class);
    }

    public function warrantyCard(){
        return $this->hasOne(WarrantyCard::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class TransactionVoucher extends Model
{
    protected $guarded = [];

    protected $casts = [
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

    public function clinic()
    {
        return $this->belongsTo(Clinic::class);
    }

    public function finance()
    {
        return $this->belongsTo(Finance::class);
    }

    public function fundingSource()
    {
        return $this->belongsTo(FundingSource::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Finance extends Model
{
    protected $guarded = [];

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

    public function transactionVouchers()
    {
        return $this->hasMany(TransactionVoucher::class);
    }
}

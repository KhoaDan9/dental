<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class FundingSource extends Model
{
    protected $guarded = [];

    protected $casts = [
        'type_of_transaction' => 'array'
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

    public function clinic()
    {
        return $this->belongsTo(Clinic::class);
    }
    public function transactionVouchers()
    {
        return $this->hasMany(TransactionVoucher::class);
    }
}

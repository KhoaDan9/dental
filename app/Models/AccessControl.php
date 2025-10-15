<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessControl extends Model
{
    /** @use HasFactory<\Database\Factories\AccessControlFactory> */
    use HasFactory;

    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function feature(){
        return $this->belongsTo(Feature::class);
    }
    public function permission(){
        return $this->belongsTo(Permission::class);
    }
}

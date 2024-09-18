<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PromoCode extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'plan_id', 'is_used', 'expires_at'];

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    protected $casts = [
        'expires_at' => 'datetime',
    ];


    public static function generateCode($length = 6)
    {
        return strtoupper(Str::random($length));
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'discount', 'discount_type',
    'expires_at', 'start_date', 'end_date', 'user_limit'];

    protected $dates = ['start_date', 'end_date'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }


}

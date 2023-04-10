<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsedCopon extends Model
{
    use HasFactory;

    protected $fillable = [
        'coupon_id', 'user_id',
    ];

    public function coupon()
    {
        return $this->hasMany(Coupon::class);
    }

    public function user()
    {
        return $this->hasMany(User::class);
    }
}

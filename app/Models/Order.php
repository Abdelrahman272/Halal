<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // const STATUS_NEW = 1;
    // const STATUS_IN_PROGREE = 2;
    // const STATUS_SHIPPED = 3;
    // const STATUS_PAID = 4;
    // const STATUS_CANCELED = 5;

    // const PAYMENT_CASH_ON_DELVIRY = 1;
    // const PAYMENT_PAYPAL = 2;

    protected $fillable = [
        'status',
        'payment_status',
        'payment_method',
        'address',
        'notes',
        'subtotal',
        'vat',
        'total',
        'user_id',
        'coupon_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot(['quantity', 'price', 'total']);
    }
}

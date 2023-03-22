<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['id','price','product_id', 'quantity'];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}

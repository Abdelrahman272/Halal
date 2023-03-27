<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'sku', 'price', 'status', 'category_id'
    ];

    protected function price(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value,
        );
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    public function photoable()
    {
        return $this->morphMany(Photo::class, 'photoable');
    }

    public function cart()
    {
        return $this->belongsToMany(Cart::class);
    }

    public function getActive()
    {
        return $this->status == 'active' ? 'active'  : 'inactive';
    }

    protected static function booted()
    {
        static::created(function ($product) {
            $product->sku = rand(1000, 9999);
            $product->save();
        });
    }
}

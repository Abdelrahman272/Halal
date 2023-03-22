<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'image', 'preparation', 'price', 'stock', 'status', 'category_id'
    ];

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
}

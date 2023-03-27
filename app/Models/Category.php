<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'status'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function photoable()
    {
        return $this->morphMany(Photo::class, 'photoable');
    }

    public function getActive()
    {
        return $this->status == 'active' ? 'active'  : 'inactive';
    }

    // public function photo() {
    //     return $this->photoable()->first() != null ? asset($this->photoable()->first()->src) : asset('uploads/categories/image-placeholder-base.png');
    // }
}

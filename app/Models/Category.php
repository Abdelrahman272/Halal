<?php

namespace App\Models;

use App\Observers\CategoryObserver;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'status'
    ];

    protected static function boot()
    {
        parent::boot();
        Category::observe(CategoryObserver::class);
    }

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

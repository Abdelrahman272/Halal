<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'AccuntNumber', 'IBAN',
    ];

    public function photos()
    {
        return $this->morphMany(Photo::class, 'photoable');
    }
}

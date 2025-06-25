<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anime extends Model
{
    protected $fillable = [
        'title',
        'year',
        'images',
        'description'
    ];

    public function reviews()
    {
        return $this->hasMany(Review::class,'anime_id');
    }
}

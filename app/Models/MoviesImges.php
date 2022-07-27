<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MoviesImges extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['image_path'];
    public function getImagePathAttribute($key)
    {
        return 'https://image.tmdb.org/t/p/w500' . $this->image;
    }
}

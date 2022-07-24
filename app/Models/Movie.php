<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends =['poster_path'];


    // attr
    public function getPosterPathAttribute($key)
    {
        return 'https://image.tmdb.org/t/p/w500' . $this->poster;
    }

    // scope
    public function scopewhenHasGenreId($q, $genre){
        return $q->when($genre , function($q) use ($genre){
            return $q->whereHas('genres' , function($q) use ($genre){
                return $q->where('genres.id', $genre);
            });
        });
    }

    public function scopewhenHasActor($q, $genre){
        return $q->when($genre , function($q) use ($genre){
            return $q->whereHas('actors' , function($q) use ($genre){
                return $q->where('actors.id', $genre);
            });
        });
    }


    // relations ----------------------
    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'movies_genres');
    }

    public function actors(){
        return $this->belongsToMany(Actor::class , 'movies_actors');
    }



}

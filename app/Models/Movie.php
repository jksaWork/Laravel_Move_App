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

    public function scopewhenType($q, $type){
                return $q->where('type', $type);
    }

    public function scopewhenYear($q, $release_date){
        return $q->where('release_date', $release_date);
    }

    public function scopeWhenSearch($query, $search)
    {
        return $query->when($search, function ($q) use ($search) {
            return $q->where('title', 'like', '%' . $search . '%');
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

    public function images(){
        return $this->hasMany(MoviesImges::class);
    }

    public function FavorateByUsers(){
        return $this->belongsToMany(User::class, 'user_favorite_movie', 'movie_id');
    }


}

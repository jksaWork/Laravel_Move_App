<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use HasApiTokens , HasFactory, Notifiable;

    /**s
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function favorateMovies(){
        return $this->belongsToMany(Movie::class, 'user_favourate_movie', 'user_id');
    }
    public function favoriteMovies()
    {
        return $this->belongsToMany(Movie::class, 'user_favorite_movie', 'user_id', 'movie_id');
    }

    // scope Wasel
    public function scopewhenHasRole($query , $role_id)
    {
        return $query->when($role_id, function($query) use($role_id){
            return $query->whereHas('roles', function($query) use ($role_id){
                return $query->where('id', $role_id);
            });
        });
    }
}

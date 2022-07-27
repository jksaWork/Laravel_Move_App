<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ActorResource;
use App\Http\Resources\ImageResource;
use App\Http\Resources\MovieResource;
use App\Models\Movie;
use App\Models\User;
use Illuminate\Http\Request;

class MoviesController extends Controller
{
    public function index(){
        $movies = Movie::
        with('genres')
            ->whenSearch(request()->search)
        ->whenType(request()->type)
        ->paginate(10);
        $data['moives'] = MovieResource::collection($movies)->response()->getData(true);
        return response()->ApiSuccess($data);
    }

    public function favoirateToggle($move_id){
            // jksa altigani omsan
            User::with('favoriteMovies')->find(auth()->user()->id)->favoriteMovies()->toggle($move_id);
            return response()->APIsuccess('Movie Was Toggle');
        }


        public function images($movie_id)
        {
            $movie = Movie::find($movie_id);
            return response()->ApiSuccess(ImageResource::collection($movie->images));

        }// end of images

        public function actors( $movie_id)
        {
            $movie = Movie::find($movie_id);
            return response()->ApiSuccess(ActorResource::collection($movie->actors));
        }// end of actors
        public function relatedMovies($movie_id)
        {
            $movie = Movie::find($movie_id);
            $movies = Movie::whereHas('genres', function ($q) use ($movie) {
                return $q->whereIn('name', $movie->genres()->pluck('name'));
            })
                ->with('genres')
                ->where('id', '!=', $movie->id)
                ->paginate(10);
            return response()->ApiSuccess(MovieResource::collection($movies));
        }// end of relatedMovies

}

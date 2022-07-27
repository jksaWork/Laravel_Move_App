<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminHomeController extends Controller
{
    public function index()
    {
        $nowPlayingMovies = Movie::where('type' , 'now_playing')->limit(5)->get();
        $popularMovies = Movie::where('type' , null)->limit(5)->get();
        $upcomingMovies = Movie::where('type' , 'up_comming')->limit(5)->get();
        return view('admin.home', compact('upcomingMovies' , 'popularMovies', 'nowPlayingMovies'));
    }

    public function getStaticdata()
    {
        return response()->json([
            'actors_count' => Actor::count(),
            'movies_count' => Movie::count(),
            'genres_count' => Genre::count(),
        ]);
    }

    public function Chart()
    {

        // $list  = DB::select('SELECT count(id) AS c , YEAR(release_date) AS ye , MONTHNAME(release_date) AS mo FROM movies GROUP BY MONTHNAME(release_date)');
        // return $list;
        $movies = Movie::whereYear('release_date', request()->year ?? 2022 )
            ->select(
                // '*',
                'id',
                DB::raw('MONTHNAME(release_date) as month'),
                DB::raw('YEAR(release_date) as year'),
                // DB::raw('COUNT(id) as total_movies'),
            )
            // ->groupBy('month')
            ->get()->groupBy('month');

            // return $movies;
                $lables = $movies->map(function($el) {
                    return count($el);
                });
                $data = $movies->keys();
                // return ;
        return response()->json([
            'data' =>$lables->values(),
            'labels' => $data,
        ]);
    }
}

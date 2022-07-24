<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Request;
use DataTables;
class MovieController extends Controller
{
    public function index(){
        if(request()->ajax()){
            $list = [];
            $actors = Actor::where('name', 'like' , '%'.request()->search.'%')->get();
            foreach ($actors as $key => $value) {
               $list[] = ['id' => $key+ 1 ,  'text' => $value->name];
            }
            return $list;
        }


        $genres = Genre::get();
        $actors = Actor::limit(5)->get();
        return view('admin.movies.index' , compact('genres', 'actors'));
    }

    public function data(){
        $q = Movie::with('genres')->select()->whenHasGenreId(request()->genre_id)->whenHasActor(request()->actor_id);
        return DataTables::of($q)
        ->addColumn('record_select', 'admin.movies.data_table.record_select')
        ->addColumn('poster', function (Movie $movie) {
            return view('admin.movies.data_table.poster' , compact('movie'));
        })
        ->addColumn('genres', function (Movie $movie) {
            return view('admin.movies.data_table.genres' , compact('movie'));
        })
        ->editColumn('created_at', function (Movie $movie) {
            return $movie->created_at->format('Y-m-d');
        })
        ->addColumn('actions', 'admin.movies.data_table.actions')
        ->rawColumns(['record_select', 'actions', 'poster'])
        ->toJson();
    }

    public function destroy (Movie $movie){
        $movie->delete();
        return redirect()->back();
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use DataTables;
class MovieController extends Controller
{
    public function index(){
        return view('admin.movies.index');
    }

    public function data(){
        $q = Movie::select();

        return DataTables::of($q)
        ->addColumn('record_select', 'admin.genres.data_table.record_select')
        ->editColumn('created_at', function (Movie $movie) {
            return $movie->created_at->format('Y-m-d');
        })
        ->addColumn('actions', 'admin.genres.data_table.actions')
        ->rawColumns(['record_select', 'actions'])
        ->toJson();
    }

    public function destroy (Movie $movie){
        $movie->delete();
        return redirect()->back();
    }

}

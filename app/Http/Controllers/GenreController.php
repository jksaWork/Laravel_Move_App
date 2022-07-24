<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;
use DataTables;

class GenreController extends Controller
{
    public function index(){
        return view('admin.genres.index');
    }

    public function data(){
        $q = Genre::select();

        return DataTables::of($q)
        ->addColumn('record_select', 'admin.genres.data_table.record_select')
        ->editColumn('created_at', function (Genre $Genre) {
            return $Genre->created_at->format('Y-m-d');
        })
        ->addColumn('actions', 'admin.genres.data_table.actions')
        ->rawColumns(['record_select', 'actions'])
        ->toJson();
    }

    public function destroy (Genre $genre){
        $genre->delete();
        return redirect()->back();
    }
}

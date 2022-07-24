<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use Illuminate\Http\Request;
use DataTables;
class ActorController extends Controller
{
    public function index(){
        return view('admin.actors.index');
    }
    public function data(){
        $q = Actor::withCount('movies');

        return DataTables::of($q)
        ->addColumn('record_select', 'admin.actors.data_table.record_select')
        ->editColumn('created_at', function (Actor $actor) {
            return $actor->created_at->format('Y-m-d');
        })
        ->addColumn('actions', 'admin.actors.data_table.actions')
        ->addColumn('image', function(Actor $actor){
            return view('admin.actors.data_table.image', compact('actor'));
        })
        ->rawColumns(['record_select', 'actions'])
        ->toJson();
    }
}

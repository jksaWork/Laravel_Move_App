<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\GenreController;
use App\Http\Controllers\API\MoviesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login' , [AuthController::class , 'login']);
Route::post('regiter' , [AuthController::class , 'regiter']);


Route::get('/genres', [GenreController::class, 'index']);
Route::get('/movies', [MoviesController::class, 'index']);
Route::get('/actors/{id}', [MoviesController::class, 'actors']);
Route::get('images/{id}', [MoviesController::class, 'images']);
Route::get('relatedMovies/{id}', [MoviesController::class, 'relatedMovies']);

Route::get('/favoirateToggle/{movie_id}', [MoviesController::class, 'favoirateToggle'])->middleware('auth:sanctum');


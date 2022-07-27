<?php

namespace App\Console\Commands;

use App\Models\Actor;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class getMovies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:movies';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public $domain , $key;
    public function __construct()
    {
        $this->domain = config('services.tmdb.domain');
        $this->key = config('services.tmdb.api_key');
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */

     public function handle(){
        $this->info('Begin Command To Get Movie ');
        $this->getPupularMovie();
        $this->getUpCommingMovie();
        $this->getNowPlayinMovie();
        $this->info('End Command To Get Movie');

     }
    public function getPupularMovie()
    {
        // $url = "/movie/popular?region=us&api_key=";
        $count = config('services.tmdb.max_page');
        echo $count;
        for ($i=1; $i <= $count; $i++) {
            $this->info('Get Movie Page' . $i);
            $url = "$this->domain/movie/popular?region=us&api_key=$this->key";
            $res = Http::withoutVerifying()->get($url);
            foreach ($res->json()['results'] as $result) {
                $movie = Movie::create([
                    'e_id' => $result['id'],
                    'title' => $result['title'],
                    'description' => $result['overview'],
                    'poster' => $result['poster_path'],
                    'banner' => $result['backdrop_path'],
                    'release_date' => $result['release_date'],
                    'vote' => $result['vote_average'],
                    'vote_count' => $result['vote_count'],
                ]);
                $this->MovieActor($movie);
                $this->MovieGrener($result , $movie);
                $this->getMovieImage($movie);
        }
        }
    }
    public function getUpCommingMovie()
    {
        // $url = "/movie/popular?region=us&api_key=";
        $this->info('UpComming Movies');
        $count = config('services.tmdb.max_page');
        for ($i=1; $i <= $count; $i++) {
            $this->info('Get Movie Page' . $i);
            $url = "$this->domain/movie/upcoming?region=us&api_key=$this->key";
            $res = Http::withoutVerifying()->get($url);
            foreach ($res->json()['results'] as $result) {
                $movie = Movie::create([
                    'e_id' => $result['id'],
                    'title' => $result['title'],
                    'description' => $result['overview'],
                    'poster' => $result['poster_path'],
                    'banner' => $result['backdrop_path'],
                    'release_date' => $result['release_date'],
                    'vote' => $result['vote_average'],
                    'type' => 'up_comming',
                    'vote_count' => $result['vote_count'],
                ]);
                $this->MovieActor($movie);
                $this->MovieGrener($result , $movie);
                $this->getMovieImage($movie);
        }
        }
    }
    public function getNowPlayinMovie()
    {
        $this->info('Now Playing Info');
        // $url = "/movie/popular?region=us&api_key=";
        $count = config('services.tmdb.max_page');
        echo $count;
        for ($i=1; $i <= $count; $i++) {
            $this->info('Get Movie Page' . $i);
            $url = "$this->domain/movie/now_playing?region=us&api_key=$this->key";
            $res = Http::withoutVerifying()->get($url);
            foreach ($res->json()['results'] as $result) {
                $movie = Movie::create([
                    'e_id' => $result['id'],
                    'title' => $result['title'],
                    'description' => $result['overview'],
                    'poster' => $result['poster_path'],
                    'banner' => $result['backdrop_path'],
                    'release_date' => $result['release_date'],
                    'vote' => $result['vote_average'],
                    'type' => 'now_playing',
                    'vote_count' => $result['vote_count'],
                ]);
                $this->MovieActor($movie);
                $this->MovieGrener($result , $movie);
                $this->getMovieImage($movie);
        }
        }
    }
    private function MovieGrener($result, Movie $movie){
        $this->info('Begin TO GET Moveis Images');
        foreach ($result['genre_ids'] as $genreId) {
            $genre = Genre::where('e_id', $genreId)->first();
            $movie->genres()->attach($genre->id);
        }
    }

    private function MovieActor(Movie $movie){
        // $this->info('The Movies Is COllected');
        $this->info('Begin TO Get Actor TO' . $movie->id);
        $url =  $this->domain . '/movie/' . $movie->e_id . '/credits?api_key=' . $this->key;
        $res = Http::withoutVerifying()->get($url);
        // dd();
        foreach ($res['cast'] as $index => $cast) {
            if ($cast['known_for_department'] != 'Acting') continue;

            if ($index == 12) break;
            $actor = Actor::where('e_id' , $cast['id'])->first();
            if(!$actor){
                $actor = Actor::create([
                    'e_id' => $cast['id'],
                    'name' => $cast['name'],
                    'image' => $cast['profile_path']
                ]);
            }
            $movie->actors()->syncWithoutDetaching($actor->id);
            # code...
        }
    }
    private function getMovieImage(Movie $movie){
        $url = $this->domain.'/movie/' . $movie->e_id . '/images?api_key=' . $this->key;
        $response = Http::withoutVerifying()->get($url);
        $movie->images()->delete();
            foreach ($response->json()['backdrops'] as $im) {
                $movie->images()->create([
                    'image' => $im['file_path']
                ]);
            }
    }
}

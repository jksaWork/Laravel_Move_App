<?php

namespace App\Console\Commands;

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
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // $url = "/movie/popular?region=us&api_key=";
        $domain = config('services.tmdb.domain');
        $key = config('services.tmdb.api_key');
        $url = "$domain/movie/popular?region=us&api_key=$key";

        $res = Http::withoutVerifying()->get($url);
        // dd($res);
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

            foreach ($result['genre_ids'] as $genreId) {
                $genre = Genre::where('e_id', $genreId)->first();
                $movie->genres()->attach($genre->id);
            }
        }
    }
}

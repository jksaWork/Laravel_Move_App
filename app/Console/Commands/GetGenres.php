<?php

namespace App\Console\Commands;

use App\Models\Genre;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class GetGenres extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:genres';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get Genraics ';

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
        $this->info('Start Of Command');

        $domain = config('services.tmdb.domain');
        $key = config('services.tmdb.api_key');
        $url = "$domain/genre/movie/list?api_key=$key";
        // echo $url . '</br>';
        $res = Http::withoutVerifying()->get($url);
        // dd($res);
        if($res->ok()){
            foreach ($res->json()['genres'] as  $value) {
                Genre::create([
                    'name' => $value['name'] ,
                    'e_id' => $value['id'],
            ]);
            }
        }
        $this->info('All Genric is Collect');
    }
}

<?php

namespace App\Providers;

use Illuminate\Routing\ResponseFactory;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        ResponseFactory::macro('ApiErrors' , function ($error = 'Some Thing Went Worong'){
            return response()->json([
                'status' => false,
                'message' => $error ,
            ]);
        });

        ResponseFactory::macro('ApiSuccess' , function ($data = 'Done SuccesFuly'){
            return response()->json([
                'status' => true,
                'message' => $data ,
            ]);
        });
    }
}

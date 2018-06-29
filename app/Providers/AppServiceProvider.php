<?php

namespace App\Providers;

use App\Model\Testnum;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //

//        DB::listen(function($query){
//            Log::info('DB sql info :',[
//                $query->sql,
//                $query->bindings,
//                $query->time
//            ]);
//        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

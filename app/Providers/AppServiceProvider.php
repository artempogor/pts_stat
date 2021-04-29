<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\PTS;
use App\Models\Status;
use App\Orchid\Screens\PtsListScreen;

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
//    public function boot(PtsListScreen $pts)
//    {
//        $pts->registerSearch(
//            [
//                PTS::class,
//            ]
//        );
//    }
}

<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        $folderImages = config('directories.images');
        $folderShows = config('directories.shows');

        $noteGood = config('param.good');
        $noteNeutral = config('param.neutral');
        $noteBad = config('param.bad');

        View::share('folderImages', $folderImages);
        View::share('folderShows', $folderShows);
        View::share('noteGood', $noteGood);
        View::share('noteNeutral', $noteNeutral);
        View::share('noteBad', $noteBad);

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

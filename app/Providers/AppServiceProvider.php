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
    public function boot()
    {
        view()->composer('layouts.header', 'App\Http\ViewComposer\CategoryComposer');
        view()->composer('page.list_category', 'App\Http\ViewComposer\CategoryComposer');
        view()->composer('page.search', 'App\Http\ViewComposer\CategoryComposer');
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

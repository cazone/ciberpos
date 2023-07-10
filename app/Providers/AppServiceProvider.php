<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Inertia\Inertia;
use Illuminate\Support\Facades\Session;

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
        Paginator::useBootstrap();
         Schema::defaultStringLength(191);

         Inertia::share("flash", function () {
            return [
                "success" =>  Session::get("success"),
                'message' => Session::get('message'),
            ];
        });
        Inertia::share("auth", function () {
            return [
                'role' => auth()->user() ? auth()->user()->getRoleNames() : null,
            ];
        });
        Inertia::share("path", function () {
            return  [
                'url' => config('app.url'),
            ];
        });

    }
}

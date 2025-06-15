<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            if (Auth::guard('kader')->check()) {
                $view->with('kader', Auth::guard('kader')->user());
            }
    
            if (Auth::guard('bidan')->check()) {
                $view->with('bidan', Auth::guard('bidan')->user());
            }
        });
    }
}

<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\SignNda;

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
        View::composer('*', function ($view) {

            $hasSignedNda = false;

            if (Auth::check() && Auth::user()->role_name === 'buyer') {

                $hasSignedNda = SignNda::where(
                    'user_id',
                    Auth::id()
                )->exists();
            }

            $view->with('hasSignedNda', $hasSignedNda);
        });
    }
}

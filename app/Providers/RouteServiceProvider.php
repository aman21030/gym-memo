<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // ログイン後のリダイレクトを /workouts に変更
        Route::middleware('web')
            ->group(function () {
                Route::get('/dashboard', function () {
                    return Redirect::to('/workouts');
                })->middleware(['auth'])->name('dashboard');
            });
    }
}

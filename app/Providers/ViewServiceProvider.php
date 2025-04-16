<?php

namespace App\Providers;

use App\Models\countries;
use App\Models\User;
use Doctrine\DBAL\Schema\View;
use Illuminate\Support\ServiceProvider;


class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        view()->composer('*', function ($view) {
            $view->with([
                'countries'=> countries::all(),
                'doctors' => User::where('role', 'doctor')->get(),
            ]);
            
        });
    }
}

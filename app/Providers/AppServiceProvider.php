<?php

namespace App\Providers;
use Illuminate\Support\Facades\View;
use Inertia\Inertia;

use Illuminate\Support\ServiceProvider;

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
        Inertia::share([
            'auth' => function () {
                return [
                    'user' => auth()->user() ? [
                        'id' => auth()->user()->id,
                        'name' => auth()->user()->name,
                        'email' => auth()->user()->email,
                        'roles' => auth()->user()->getRoleNames()->toArray(),  // Asegúrate de devolver un array
                        ] : null,
                ];
            },
        ]);
    }
}

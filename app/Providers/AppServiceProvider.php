<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
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
        // Forzar HTTPS en producción para evitar mixed-content
        if (app()->environment('production')) {
            URL::forceScheme('https');
            
            // Forzar a que la solicitud entrante sea considerada HTTPS siempre en el servidor
            if (! app()->runningInConsole()) {
                request()->server->set('HTTPS', 'on');
                request()->server->set('SERVER_PORT', 443);
            }
        }
    }
}

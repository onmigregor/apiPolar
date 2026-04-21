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
        // Si la URL de la app es HTTPS, forzamos que todo el framework (incluyendo firmas de Livewire)
        // se genere y valide bajo HTTPS y el dominio correcto, sin importar los proxies.
        if (str_starts_with(config('app.url'), 'https://')) {
            URL::forceScheme('https');
            URL::forceRootUrl(config('app.url'));
        }
    }
}

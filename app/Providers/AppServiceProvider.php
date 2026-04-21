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
            
            // "Plan C Extendido": Forzamos a que Laravel no confíe ni siquiera en el "Host" que envía LiteSpeed
            if (!app()->runningInConsole() && request()) {
                request()->server->set('HTTPS', 'on');
                request()->server->set('HTTP_X_FORWARDED_PROTO', 'https');
                request()->server->set('SERVER_PORT', 443);
                
                // LiteSpeed suele perder el Host original, obligamos a usar la URL configurada
                $host = parse_url(config('app.url'), PHP_URL_HOST);
                request()->headers->set('host', $host);
                request()->server->set('HTTP_HOST', $host);
                request()->server->set('HTTP_X_FORWARDED_HOST', $host);
            }
        }
    }
}

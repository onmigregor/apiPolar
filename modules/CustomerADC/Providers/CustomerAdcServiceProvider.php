<?php

namespace Modules\CustomerADC\Providers;

use Illuminate\Support\ServiceProvider;

class CustomerAdcServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'customer-adc');
    }

    public function register(): void
    {
        //
    }
}

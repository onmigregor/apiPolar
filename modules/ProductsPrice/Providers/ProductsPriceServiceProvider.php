<?php

namespace Modules\ProductsPrice\Providers;

use Illuminate\Support\ServiceProvider;

class ProductsPriceServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'products-price');
    }

    public function register(): void
    {
        //
    }
}

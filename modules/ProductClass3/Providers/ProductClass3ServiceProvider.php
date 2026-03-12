<?php

namespace Modules\ProductClass3\Providers;

use Illuminate\Support\ServiceProvider;

class ProductClass3ServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
        $this->app->register(RouteServiceProvider::class);
    }
}

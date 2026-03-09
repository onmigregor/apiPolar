<?php

namespace Modules\ProductFamily\Providers;

use Illuminate\Support\ServiceProvider;

class ProductFamilyServiceProvider extends ServiceProvider
{
    public function boot(): void
       {
           $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');

           $this->app->register(RouteServiceProvider::class);
       }
}

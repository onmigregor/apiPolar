<?php

namespace Modules\ProductCategory\Providers;

use Illuminate\Support\ServiceProvider;

class ProductCategoryServiceProvider extends ServiceProvider
{
    public function boot(): void
       {
           $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
           $this->app->register(RouteServiceProvider::class);
       }
}

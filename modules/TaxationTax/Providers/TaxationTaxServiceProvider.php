<?php

namespace Modules\TaxationTax\Providers;

use Illuminate\Support\ServiceProvider;

class TaxationTaxServiceProvider extends ServiceProvider
{
    public function boot(): void
       {
           $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
          // $this->mergeConfigFrom(__DIR__.'/../config.php', 'clientCategory');

           $this->app->register(RouteServiceProvider::class);
       }
}

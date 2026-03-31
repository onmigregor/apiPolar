<?php

namespace Modules\CustomerInfoType\Providers;

use Illuminate\Support\ServiceProvider;

class CustomerInfoTypeServiceProvider extends ServiceProvider
{
    public function boot(): void
       {
           $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
          // $this->mergeConfigFrom(__DIR__.'/../config.php', 'clientCategory');

           $this->app->register(RouteServiceProvider::class);
       }
}

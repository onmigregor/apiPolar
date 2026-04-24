<?php

namespace Modules\DynamicPlan\Providers;

use Illuminate\Support\ServiceProvider;

class DynamicPlanServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
        $this->loadViewsFrom(__DIR__.'/../Resources/views', 'dynamicplan');
        
        \Livewire\Livewire::component('dynamicplan::planes-dinamicos-table', \Modules\DynamicPlan\Http\Livewire\PlanesDinamicosTable::class);
    }

    public function register(): void
    {
        //
    }
}

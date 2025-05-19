<?php

namespace Aaran\Frappe\Providers;

use Aaran\Frappe\Livewire\Class;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class FrappeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->register(FrappeRouteProvider::class);
        $this->loadViews();
    }

    public function boot(): void
    {
        Livewire::component('frappe::stock-sync', Class\StockSync::class);
        Livewire::component('frappe::stock-list', Class\StockList::class);
        Livewire::component('frappe::stock-show', Class\StockShow::class);
        Livewire::component('frappe::stock-client', Class\StockClient::class);

        $this->registerMigrations();

    }

    protected function loadViews(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../Livewire/Views', 'frappe');
    }

    private function registerMigrations()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }
}

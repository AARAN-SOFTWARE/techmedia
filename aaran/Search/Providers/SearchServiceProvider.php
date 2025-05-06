<?php

namespace Aaran\Search\Providers;

use Aaran\Search\Livewire\Class\GlobalSearch;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class SearchServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->registerMigrations();

        $this->loadViewsFrom(__DIR__ . '/../Livewire/Views', 'search');

        Livewire::component('search::global-search', GlobalSearch::class);
    }

    private function registerMigrations()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }
}

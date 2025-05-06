<?php

namespace Aaran\UI\Providers;

use Aaran\UI\Livewire\Class\GlobalSearch;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class UiServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../Resources', 'Ui'); // Important: Load views from module

        $this->loadViewsFrom(__DIR__ . '/../Livewire/Views', 'comp'); // Important: Load views from module


        Livewire::component('comp::global-search', GlobalSearch::class);
    }
}

<?php

namespace Aaran\UI\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class UiServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../Resources', 'Ui'); // Important: Load views from module
    }
}

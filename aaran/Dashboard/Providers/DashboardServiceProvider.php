<?php

namespace Aaran\Dashboard\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class DashboardServiceProvider extends ServiceProvider
{
    protected string $moduleNameLower = 'dashboard';

    public function register()
    {
        $this->app->register(DashboardRouteProvider::class);
    }

    public function boot()
    {
        $this->registerViews();
    }

    private function registerViews()
    {
        $this->loadViewsFrom(__DIR__ . '/../Livewire/Views', $this->moduleNameLower);

    }
}

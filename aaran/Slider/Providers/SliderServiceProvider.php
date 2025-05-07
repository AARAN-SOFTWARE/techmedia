<?php

namespace Aaran\Slider\Providers;

use Aaran\Slider\Livewire\Class;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class SliderServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->register(SliderRouteProvider::class);
        $this->loadViews();
    }

    public function boot(): void
    {
        Livewire::component('slider::slider-list', Class\SliderList::class);

        $this->registerMigrations();

    }

    protected function loadViews(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../Livewire/Views', 'slider');
    }

    private function registerMigrations()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }
}

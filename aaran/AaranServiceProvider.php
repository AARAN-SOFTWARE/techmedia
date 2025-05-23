<?php

namespace Aaran;

use Aaran\Dashboard\Providers\DashboardServiceProvider;
use Aaran\Frappe\Providers\FrappeServiceProvider;
use Aaran\Search\Providers\SearchServiceProvider;
use Aaran\Slider\Providers\SliderServiceProvider;
use Aaran\UI\Providers\UiServiceProvider;
use Aaran\Website\Providers\WebsiteServiceProvider;
use Illuminate\Support\ServiceProvider;

class AaranServiceProvider  extends ServiceProvider
{
    public function register(): void
    {
        $this->app->register(UiServiceProvider::class);
        $this->app->register(WebsiteServiceProvider::class);
        $this->app->register(DashboardServiceProvider::class);
        $this->app->register(FrappeServiceProvider::class);
        $this->app->register(SearchServiceProvider::class);
        $this->app->register(SliderServiceProvider::class);
    }
}

<?php

namespace Aaran;

use Aaran\UI\Providers\UiServiceProvider;
use Aaran\Website\Providers\WebsiteServiceProvider;
use Illuminate\Support\ServiceProvider;

class AaranServiceProvider  extends ServiceProvider
{
    public function register(): void
    {
        $this->app->register(UiServiceProvider::class);
        $this->app->register(WebsiteServiceProvider::class);
    }
}

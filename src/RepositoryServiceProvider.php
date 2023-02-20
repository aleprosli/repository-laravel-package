<?php

namespace Aleprosli\RepositoryPattern;

use Illuminate\Support\ServiceProvider;
use Aleprosli\RepositoryPattern\Commands\RepositoryPattern;

class RepositoryServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../stubs', 'RepositoryPattern');
        $this->publishes([
            __DIR__.'/stubs' => base_path('/App/stubs')]);
    }

    public function register()
    {
        $this->commands([
            RepositoryPattern::class,
        ]);
    }
}
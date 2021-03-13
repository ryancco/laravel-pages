<?php

namespace Ryancco\Pages;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Ryancco\Pages\Http\Controllers\PagesController;

class PagesServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publish();

        $this->map();

        $this->load();
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/pages.php', 'pages');
        $this->app->singleton('pages', fn() => new Manager);
    }

    private function publish()
    {
        $this->publishes([
            __DIR__.'/../config/pages.php' => config_path('pages.php'),
        ], 'config');
    }

    private function map()
    {
        Route::get(Pages::route(), PagesController::class)
            ->where('page', '.*')
            ->middleware(Pages::middleware());
    }

    private function load()
    {
        $this->loadViewsFrom(Pages::path(), 'pages');
    }
}

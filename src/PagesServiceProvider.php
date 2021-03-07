<?php

namespace Ryancco\Pages;

use Illuminate\Support\ServiceProvider;
use Ryancco\Pages\Http\Controllers\PagesController;

class PagesServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/pages.php' => config_path('pages.php'),
        ], 'config');

        $this->app['router']->get(
            trim(config('pages.route.prefix', 'pages'), '/').'/{page}', PagesController::class
        )->where('page', '.*');

        $this->loadViewsFrom(config('pages.views.path'), 'pages');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/pages.php', 'pages');
    }
}

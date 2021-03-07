<?php

namespace Ryancco\Pages\Tests;

use Illuminate\Support\Facades\Route;
use Ryancco\Pages\PagesServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app): array
    {
        return [
            PagesServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('pages', [
            'views' => [
                'path' => __DIR__.'/pages',
            ],
            'route' => [
                'prefix' => 'testing',
                'middleware' => [
                    \Ryancco\Pages\Tests\Mocks\MockMiddleware::class
                ]
            ]
        ]);

        $this->registerRoutes();
    }

    /**
     * Register routes before the package routes are registered.
     */
    protected function registerRoutes(): void
    {
        Route::get(config('pages.route.prefix').'/specific', function () {
            return 'This is not a wildcard route';
        });
    }
}

<?php

namespace Ryancco\Pages\Tests;

use Illuminate\Support\Facades\Config;
use Ryancco\Pages\Events\IncomingPageRequest;
use Ryancco\Pages\Events\PageFound;
use Ryancco\Pages\Events\PageNotFound;
use Ryancco\Pages\Http\Controllers\PagesController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PagesControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutExceptionHandling();
    }

    /** @test */
    public function loads_the_expected_view(): void
    {
        $this->get('testing/test')
            ->assertSee('Hello World!')
            ->assertOk()
            ->assertViewIs('pages::test');
    }

    /** @test */
    public function throws_an_exception_and_fires_expected_events_if_view_is_missing(): void
    {
        $this->expectException(NotFoundHttpException::class);

        $this->expectsEvents([
            IncomingPageRequest::class,
            PageNotFound::class,
        ]);

        $this->get('testing/missing')
            ->assertNotFound();
    }

    /** @test */
    public function handles_multi_level_directory_structures(): void
    {
        $this->get('testing/multi/level')
            ->assertSee('It handles multi-level directory structures.')
            ->assertOk()
            ->assertViewIs('pages::multi.level');
    }

    /** @test */
    public function can_run_alongside_non_wildcard_routes(): void
    {
        $this->get('testing/test')
            ->assertSee('Hello World!')
            ->assertOk()
            ->assertViewIs('pages::test');

        $this->get('testing/specific')
            ->assertSee('This is not a wildcard route')
            ->assertOk();
    }

    /** @test */
    public function fires_expected_events(): void
    {
        $this->expectsEvents([
            IncomingPageRequest::class,
            PageFound::class,
        ]);

        $this->get('testing/test');
    }

    /** @test */
    public function loads_the_configured_middleware(): void
    {
        $this->assertEquals([
            \Ryancco\Pages\Tests\Mocks\MockMiddleware::class
        ], $this->app
            ->make(\Illuminate\Routing\Router::class)
            ->getRoutes()
            ->getByAction(PagesController::class)
            ->gatherMiddleware()
        );
    }
}

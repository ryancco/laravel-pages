<?php

namespace Ryancco\Pages\Tests;

class HelpersTest extends TestCase
{
    /** @test */
    public function routes_to_the_expected_page(): void
    {
        $this->assertEquals(
            rtrim(config('app.url'), '/').'/testing/test/page',
            page('test/page')
        );
    }

    /** @test */
    public function converts_dots_to_slashes(): void
    {
        $this->assertEquals(
            rtrim(config('app.url'), '/').'/testing/test/page',
            page('test.page')
        );
    }
}

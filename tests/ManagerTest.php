<?php

namespace Ryancco\Pages\Tests;

use Ryancco\Pages\Manager;

class ManagerTest extends TestCase
{
    /** @test */
    public function can_pull_all_page_files(): void
    {
        $pages = (new Manager)->getPageFiles();

        $this->assertCount(4, $pages);
        $this->assertContains('multi/level.blade.php', $pages);
        $this->assertContains('test.blade.php', $pages);
    }

    /** @test */
    public function it_gets_the_page_name_from_a_path()
    {
        $manager = new Manager;

        $this->assertEquals('pages::test', $manager->getViewNameFromPath('testing/test'));
        $this->assertEquals('pages::index', $manager->getViewNameFromPath('testing'));
        $this->assertEquals('pages::multi.index', $manager->getViewNameFromPath('testing/multi'));
    }

    /** @test */
    public function routes_to_the_expected_page(): void
    {
        $this->assertEquals(
            rtrim(config('app.url'), '/').'/testing/test/page',
            (new Manager)->url('test/page')
        );
    }

    /** @test */
    public function converts_dots_to_slashes(): void
    {
        $this->assertEquals(
            rtrim(config('app.url'), '/').'/testing/test/page/multi',
            (new Manager)->url('test.page.multi')
        );
    }

    /** @test */
    public function stores_and_retrieves_variables(): void
    {
        $manager = new Manager;

        $manager->setVariable('single', 'value');
        $manager->setVariable([
            'foo' => 'bar',
            'baz' => 'qwex',
        ]);

        $this->assertEquals([
            'single' => 'value',
            'foo' => 'bar',
            'baz' => 'qwex'
        ], $manager->getVariables());
    }
}

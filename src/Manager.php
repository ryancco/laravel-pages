<?php

namespace Ryancco\Pages;

use Illuminate\Support\Str;
use Symfony\Component\Finder\Finder;

class Manager
{
    public function view(string $page)
    {
        return view()->make($page);
    }

    public function url(string $page): string
    {
        return url(
            Str::of($this->prefix())
                ->trim('/')
                ->append('/')
                ->append(
                    Str::of($page)->replace('.', '/')
                )
        );
    }

    public function getViewNameFromPath(string $path): string
    {
        $page = Str::of($path)
            ->after(
                Str::of($this->prefix())
            )->trim('/')
            ->prepend('pages::')
            ->replace('/', '.');

        if (! $this->exists($page)) {
            $page = $page->is('pages::')
                ? $page->append('index')
                : $page->append('.index');
        }

        return $page;
    }

    public function exists(string $page): bool
    {
        return view()->exists($page);
    }

    public function path(): string
    {
        return (string) config('pages.views.path');
    }

    public function route(): string
    {
        return trim(config('pages.route.prefix', 'pages'), '/').'/{page}';
    }

    public function prefix(): string
    {
        return (string) config('pages.route.prefix');
    }

    public function middleware(): array
    {
        return (array) config('pages.route.middleware');
    }

    public function getPageFiles(): array
    {
        return collect(
            Finder::create()
                ->files()
                ->name(['*.blade.php'])
                ->in($this->path())
                ->sortByName()
        )->map(fn($file) => $file->getRelativePathname())
            ->values()
            ->toArray();
    }
}

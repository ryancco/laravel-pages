<?php

namespace Ryancco\Pages\Tests\Mocks;

class MockMiddleware
{
    public function handle($request, \Closure $next)
    {
        return $next($request);
    }
}

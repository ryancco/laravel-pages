<?php

namespace Ryancco\Pages;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Ryancco\Pages\Manager
 */
class Pages extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'pages';
    }
}

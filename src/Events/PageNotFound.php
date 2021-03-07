<?php

namespace Ryancco\Pages\Events;

use Illuminate\Http\Request;

class PageNotFound
{
    public $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }
}

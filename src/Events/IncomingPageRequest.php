<?php

namespace Ryancco\Pages\Events;

use Ryancco\Pages\Http\Requests\PageRequest;

class IncomingPageRequest
{
    public $request;

    public function __construct(PageRequest $request)
    {
        $this->request = $request;
    }
}
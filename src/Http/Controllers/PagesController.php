<?php

namespace Ryancco\Pages\Http\Controllers;

use Ryancco\Pages\Events\IncomingPageRequest;
use Ryancco\Pages\Events\PageFound;
use Ryancco\Pages\Events\PageNotFound;
use Ryancco\Pages\Http\Requests\PageRequest;

class PagesController
{
    public function __invoke(PageRequest $request)
    {
        event(new IncomingPageRequest($request));

        if (! view()->exists($request->view())) {
            event(new PageNotFound($request));

            abort(404);
        }

        event(new PageFound($request));

        return view($request->view());
    }
}

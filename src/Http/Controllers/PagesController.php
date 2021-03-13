<?php

namespace Ryancco\Pages\Http\Controllers;

use Illuminate\Http\Request;
use Ryancco\Pages\Events\IncomingPageRequest;
use Ryancco\Pages\Events\PageFound;
use Ryancco\Pages\Events\PageNotFound;
use Ryancco\Pages\Pages;

class PagesController
{
    public function __invoke(Request $request)
    {
        event(new IncomingPageRequest($request));

        $page = Pages::getViewNameFromPath($request->path());

        if (! Pages::exists($page)) {
            event(new PageNotFound($request));

            abort(404);
        }

        event(new PageFound($request));

        return Pages::render($page);
    }
}

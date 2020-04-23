<?php

namespace Ryancco\Pages;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PagesController
{
    public function __invoke(Request $request)
    {
        $view = 'pages::'.Str::after(
            $request->path(), trim(config('pages.route.prefix'), '/').'/'
        );

        if (! view()->exists($view)) {
            abort(404);
        }

        return view($view);
    }
}

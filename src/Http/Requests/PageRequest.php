<?php

namespace Ryancco\Pages\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class PageRequest extends FormRequest
{
    public function rules()
    {
        return [];
    }

    public function view()
    {
        return 'pages::'.Str::after(
                $this->path(), trim(config('pages.route.prefix'), '/').'/'
            );
    }
}

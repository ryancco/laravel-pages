<?php

if (!function_exists('page')) {
    /**
     * Route to the specified page using dot notation.
     *
     * @param string $name
     *
     * @return string
     */
    function page($name)
    {
        return url(
            rtrim(config('pages.route.prefix'), '/') . '/' . \Illuminate\Support\Str::replaceArray('.', ['/'], $name)
        );
    }
}

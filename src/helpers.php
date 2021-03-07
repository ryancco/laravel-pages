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
        return \Ryancco\Pages\Pages::url($name);
    }
}

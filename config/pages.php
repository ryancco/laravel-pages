<?php

return [
    'views' => [
        /*
         *  The directory path to all of your static views.
         */
        'path' => resource_path('pages'),
    ],
    'route' => [
        /*
         * The route prefix to serve all of your static pages from.
         */
        'prefix' => 'pages',

        /**
         * The middleware that your static pages should be served through.
         */
        'middleware' => [
            \Illuminate\Session\Middleware\StartSession::class
        ],
    ]
];

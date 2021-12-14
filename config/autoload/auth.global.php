<?php

use App\Http\Middleware\BasicAuthActionMiddleware;

return [
    'dependencies' => [
        'factories' => [
            BasicAuthActionMiddleware::class => Infrastructure\App\Http\Middleware\BasicAuthMiddlewareFactory::class,
        ],
    ],

    'auth' => [
        'users' => [],
    ],
];
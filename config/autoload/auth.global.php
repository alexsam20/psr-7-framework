<?php

use App\Http\Middleware\BasicAuthActionMiddleware;
use Psr\Container\ContainerInterface;

return [
    'dependencies' => [
        'factories' => [
            BasicAuthActionMiddleware::class => function (ContainerInterface $container) {
                return new BasicAuthActionMiddleware($container->get('config')['auth']['users']);
            },
        ],
    ],

    'auth' => [
        'users' => [],
    ],
];
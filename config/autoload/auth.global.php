<?php

use App\Http\Middleware\BasicAuthActionMiddleware;
use Psr\Container\ContainerInterface;
use Zend\Diactoros\Response;

return [
    'dependencies' => [
        'factories' => [
            BasicAuthActionMiddleware::class => function (ContainerInterface $container) {
                return new BasicAuthActionMiddleware($container->get('config')['auth']['users'], new Response());
            },
        ],
    ],

    'auth' => [
        'users' => [],
    ],
];
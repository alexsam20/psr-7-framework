<?php

use App\Http\Middleware;
use App\Http\Action;
use Framework\Container\Container;
use Framework\Http\Application;
use Framework\Http\Pipeline\MiddlewareResolver;
use Framework\Http\Router\AuraRouterAdapter;
use Framework\Http\Router\Router;

return [
    Application::class => function (Container $container) {
        return new Application(
            $container->get(MiddlewareResolver::class),
            $container->get(Router::class),
            new Middleware\NotFoundHandler(),
            new Zend\Diactoros\Response()
        );
    },

    Router::class => function () {
        return new AuraRouterAdapter(new Aura\Router\RouterContainer());
    },

    MiddlewareResolver::class => function (Container $container) {
        return new MiddlewareResolver($container);
    },

    Middleware\BasicAuthActionMiddleware::class => function (Container $container) {
        return new Middleware\BasicAuthActionMiddleware($container->get('config')['users']);
    },

    Middleware\ErrorHandlerMiddleware::class => function (Container $container) {
        return new Middleware\ErrorHandlerMiddleware($container->get('config')['debug']);
    }
];

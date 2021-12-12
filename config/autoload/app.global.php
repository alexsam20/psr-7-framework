<?php

use App\Http\Middleware\ErrorHandler;
use Framework\Http\Application;
use Framework\Http\Pipeline\MiddlewareResolver;
use Framework\Http\Router\AuraRouterAdapter;
use Framework\Http\Router\Router;
use Framework\Template\TemplateRenderer;
use Psr\Container\ContainerInterface;

return [
    'dependencies' => [
        'abstract_factories' => [
            Zend\ServiceManager\AbstractFactory\ReflectionBasedAbstractFactory::class,
        ],
        'factories' => [
            Application::class => function (ContainerInterface $container) {
                return new Application(
                    $container->get(MiddlewareResolver::class),
                    $container->get(Router::class),
                    $container->get(App\Http\Middleware\NotFoundHandler::class)
                );
            },
            Router::class => function () {
                return new AuraRouterAdapter(new Aura\Router\RouterContainer());
            },
            MiddlewareResolver::class => function (ContainerInterface $container) {
                return new MiddlewareResolver($container, new Zend\Diactoros\Response());
            },
            ErrorHandler\ErrorHandlerMiddleware::class => function (ContainerInterface $container) {
                return new ErrorHandler\ErrorHandlerMiddleware(
                    $container->get(ErrorHandler\ErrorResponseGenerator::class)
                );
            },
            ErrorHandler\ErrorResponseGenerator::class => function (ContainerInterface $container) {
                if ($container->get('config')['debug']) {
                    return new ErrorHandler\DebugErrorResponseGenerator(
                        $container->get(TemplateRenderer::class),
                        'error/error-debug'
                    );
                }
                return new ErrorHandler\PrettyErrorResponseGenerator(
                    $container->get(TemplateRenderer::class),
                    [
                        '404' => 'error/404',
                        '403' => 'error/403',
                        'error' => 'error/error',
                    ]
                );
            },
        ],
    ],

    'debug' => false,
];

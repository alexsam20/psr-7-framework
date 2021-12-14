<?php

use Framework\Http\Middleware\ErrorHandler;
use Framework\Http\Application;
use Framework\Http\Pipeline\MiddlewareResolver;
use Framework\Http\Router\AuraRouterAdapter;
use Framework\Http\Router\Router;
use Framework\Template\TemplateRenderer;
use Infrastructure\Framework\Http\Middleware\ErrorHandler\LogErrorListener;
use Infrastructure\Framework\Http\Middleware\ErrorHandler\PrettyErrorResponseGenerator;
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
                $middleware = new ErrorHandler\ErrorHandlerMiddleware(
                    $container->get(ErrorHandler\ErrorResponseGenerator::class)
                );
                $middleware->addListener($container->get(LogErrorListener::class));
                return $middleware;
            },
            ErrorHandler\ErrorResponseGenerator::class => function (ContainerInterface $container) {
                if ($container->get('config')['debug']) {
                    return new ErrorHandler\WhoopsErrorResponseGenerator(
                        $container->get(Whoops\RunInterface::class),
                        new Zend\Diactoros\Response(),
                    );
                }
                return new PrettyErrorResponseGenerator(
                    $container->get(TemplateRenderer::class),
                    new Zend\Diactoros\Response(),
                    [
                        '404' => 'error/404',
                        '403' => 'error/403',
                        'error' => 'error/error',
                    ]
                );
            },
            Whoops\RunInterface::class => function () {
                $whoops = new Whoops\Run();
                $whoops->writeToOutput(false);
                $whoops->allowQuit(false);
                $whoops->pushHandler(new Whoops\Handler\PrettyPageHandler());
                $whoops->register();
                return $whoops;
            },
            Psr\Log\LoggerInterface::class => function (ContainerInterface $container)
            {
                $logger = new Monolog\Logger('App');
                $logger->pushHandler(new Monolog\Handler\StreamHandler(
                    'var/log/application.log',
                    $container->get('config')['debug'] ? Monolog\Logger::DEBUG : Monolog\Logger::WARNING
                ));
                return $logger;
            },
        ],
    ],

    'debug' => false,
];

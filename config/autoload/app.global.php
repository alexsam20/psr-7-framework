<?php

use Framework\Http\Application;
use Framework\Http\Middleware\ErrorHandler\ErrorHandlerMiddleware;
use Framework\Http\Middleware\ErrorHandler\ErrorResponseGenerator;
use Framework\Http\Pipeline\MiddlewareResolver;
use Framework\Http\Router\Router;
use Infrastructure\Framework\Http\Middleware\ErrorHandler\ErrorHandlerMiddlewareFactory;
use Infrastructure\Framework\Http\Middleware\ErrorHandler\PrettyErrorResponseGeneratorFactory;

return [
    'dependencies' => [
        'abstract_factories' => [
            Zend\ServiceManager\AbstractFactory\ReflectionBasedAbstractFactory::class,
        ],
        'factories' => [
            Application::class => Infrastructure\Framework\Http\ApplicationFactory::class,
            Router::class => Infrastructure\Framework\Http\Router\AuraRouterFactory::class,
            MiddlewareResolver::class => Infrastructure\Framework\Http\Pipeline\MiddlewareResolverFactory::class,
            ErrorHandlerMiddleware::class => ErrorHandlerMiddlewareFactory::class,
            ErrorResponseGenerator::class => PrettyErrorResponseGeneratorFactory::class,
            Psr\Log\LoggerInterface::class => Infrastructure\App\Logger\LoggerFactory::class,
            PDO::class => Infrastructure\App\PDOFactory::class,
        ],
    ],

    'debug' => false,
];

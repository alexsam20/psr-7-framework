<?php

use App\Http\Middleware;

/** @var \Framework\Container\Container $container */
/** @var \Framework\Http\Application $app */

$app->pipe($container->get(Middleware\ErrorHandlerMiddleware::class));
$app->pipe(Middleware\CredentialsMiddleware::class);
$app->pipe(Middleware\ProfilerMiddleware::class);
$app->pipe($container->get(Framework\Http\Middleware\RouteMiddleware::class));

$app->pipe('cabinet', $container->get(Middleware\BasicAuthActionMiddleware::class));

$app->pipe($container->get(Framework\Http\Middleware\DispatchMiddleware::class));
